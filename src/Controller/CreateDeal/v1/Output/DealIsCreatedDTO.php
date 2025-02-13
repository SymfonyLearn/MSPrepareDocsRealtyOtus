<?php

declare(strict_types=1);

namespace App\Controller\CreateDeal\v1\Output;

final class DealIsCreatedDTO
{
    /**
     * @var int Идентификатор сделки
     */
    private int $id;

    /**
     * DealIsCreatedDTO constructor.
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
