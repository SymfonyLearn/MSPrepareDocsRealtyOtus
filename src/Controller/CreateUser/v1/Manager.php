<?php

declare(strict_types=1);

namespace App\Controller\CreateUser\v1;

use App\Controller\CreateUser\v1\Input\CreateUserDTO;
use App\Entity\User;
use App\Entity\ValueObject\Email;
use App\Entity\ValueObject\Id;
use App\Entity\ValueObject\UserName;
use App\Entity\ValueObject\Password;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Manager
{

    /**
     * @var EntityManagerInterface $entityManager
     */
    private EntityManagerInterface $entityManager;

    /**
     * @var UserPasswordEncoderInterface $userPasswordEncoder
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    /**
     * Manager constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $userPasswordEncoder
    ) {
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    public function createUser(CreateUserDTO $createUserDTO): User
    {
        $roles = $createUserDTO->getRoles();
        // всегда добавляем ROLE_USER
        $roles[] = 'ROLE_USER';
        $roles = array_unique($roles);

        // todo Создание и сохранение объявления в БД
        // todo Поле Id должно генерироваться автоматически
        $user = new User(
            new Email($createUserDTO->getEmail()),
            new UserName($createUserDTO->getName()),
            new Password($createUserDTO->getPassword()),
            $roles
        );

        $user->setPassword(
            new Password($this->userPasswordEncoder->encodePassword($user, $user->getPassword()->value()))
        );

        // tell Doctrine you want to (eventually) save the Entity (no queries yet)
        $this->entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        return $user;
    }
}
