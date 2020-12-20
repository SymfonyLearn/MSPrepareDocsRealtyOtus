<?php

declare(strict_types=1);

namespace App\Controller\CreateUser\v1\Input;

use JMS\Serializer\Annotation as Serializer;

final class CreateUserDTO
{

    /**
     * @var string E-mail
     */
    private string $email;

    /**
     * @var string ФИО
     */
    private string $name;

    /**
     * @var string Пароль
     */
    private string $password;

    /**
     * @var string[] Роли
     * @Serializer\Type("array")
     */
    private array $roles;

    /**
     * CreateUserDTO constructor.
     * @param string $email
     * @param string $name
     * @param string $password
     * @param string[] $roles
     */
    public function __construct(string $email, string $name, string $password, array $roles)
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

}
