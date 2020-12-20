<?php

declare(strict_types=1);

namespace App\Controller\CreateUser\v1;

use App\Controller\CreateUser\v1\Input\CreateUserDTO;
use App\Controller\CreateUser\v1\Output\UserIsCreatedDTO;
use App\Entity\ValueObject\Password;

use Doctrine\ORM\EntityManagerInterface;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Controller extends AbstractFOSRestController
{
    /**
     * @var Manager $manager
     */
    private Manager $manager;

    /**
     * Controller constructor.
     * @param Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Rest\Post("api/v1/user")
     * @ParamConverter("createUserDTO", converter="fos_rest.request_body")
     *
     * @param CreateUserDTO $createUserDTO
     * @return Response
     */
    public function createUser(CreateUserDTO $createUserDTO): Response
    {
        $user = $this->manager->createUser($createUserDTO);

        $responseDTO = new UserIsCreatedDTO($user->getId());
        $view = $this->view($responseDTO, 200);

        return $this->handleView($view);
    }
}
