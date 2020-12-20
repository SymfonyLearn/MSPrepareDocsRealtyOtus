<?php

declare(strict_types=1);

namespace App\Controller\CreateDealEvent\v1;

use App\Controller\CreateDealEvent\v1\Input\CreateDealEventDTO;
use App\Entity\Deal;

class Manager
{

    public function createDealEvent(Deal $deal, CreateDealEventDTO $dto): void
    {
        // todo Добавление события к сделке
    }
}
