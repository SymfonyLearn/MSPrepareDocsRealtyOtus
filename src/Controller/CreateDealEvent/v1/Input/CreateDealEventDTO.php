<?php

declare(strict_types=1);

namespace App\Controller\CreateDealEvent\v1\Input;

final class CreateDealEventDTO
{
    /**
     * @var string Статус сделки
     */
    private string $status;

    /**
     * CreateDealEventDTO constructor.
     * @param  string  $status
     */
    public function __construct(string $status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

}
