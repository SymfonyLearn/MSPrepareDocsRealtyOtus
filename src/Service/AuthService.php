<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthService
{
    // @todo возможно другой объект
    /** @var User $user */
    private $user;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    public function __construct(
        User $user,
        UserPasswordEncoderInterface $passwordEncoder,
        EntityManagerInterface $em
    )
    {
        $this->user = $user;
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $em;
    }

    public function isCredentialsValid(string $email, string $password): bool
    {
        $user = $this->em->getRepository(User::class)->findOneByEmail($email);

        if ($user === null) {
            return false;
        }

        return $this->passwordEncoder->isPasswordValid($user, $password);
    }

}
