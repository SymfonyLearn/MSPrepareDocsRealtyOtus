<?php

declare(strict_types=1);

namespace App\Controller\UpdateAd\v1;

use App\Controller\UpdateAd\v1\Input\UpdateAdDTO;
use App\Entity\Ad;

class Manager
{
    public function updateAd(Ad $ad, UpdateAdDTO $dto): void
    {
        // todo Обновление объявления в БД
    }
}
