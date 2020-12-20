<?php

declare(strict_types=1);

namespace App\Controller\CreateUser\v1\Output;

final class UserIsCreatedDTO
{
    /**
     * @var int Идентификатор пользователя
     */
    private int $id;

    /**
     * UserIsCreatedDTO constructor.
     * @param  int  $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}
