<?php

declare(strict_types=1);

namespace App\Controller\CreateAd\v1\Output;

final class AdIsCreatedDTO
{
    /**
     * @var int Идентификатор объявления
     */
    private int $id;

    /**
     * AdIsCreatedDTO constructor.
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
