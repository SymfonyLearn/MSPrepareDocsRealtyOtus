<?php


namespace App\Security;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class ApiBasicAuthenticator extends AbstractGuardAuthenticator
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new JsonResponse(['message' => 'Auth required'], Response::HTTP_UNAUTHORIZED);
    }

    public function supports(Request $request)
    {
        return true;
    }

    public function getCredentials(Request $request)
    {
        $extractor = new AuthorizationHeaderTokenExtractor('Basic', 'Authorization');
        $response = $extractor->extract($request);

        return $response;
    }

    public function getUser($credentials, UserProviderInterface $user)
    {
        $credentialsDecoded = base64_decode($credentials);
        $crd = explode(':', $credentialsDecoded);
        $useremail = $crd[0];

        $user = $this->em->getRepository(User::class)->findOneByEmail($useremail);
        if ($user === null) {
            return false;
        }
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $user !== null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(['message' => 'Invalid password'], Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        // все хорошо
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
