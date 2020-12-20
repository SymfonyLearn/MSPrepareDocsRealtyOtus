<?php

declare(strict_types=1);

namespace App\Controller\LoadAd\v1;

use App\Controller\LoadAd\v1\Output\AdIsLoadedDTO;
use App\Entity\Ad;

/**
 * Class Mapper
 * @package App\Controller\LoadAd\v1
 */
class Mapper
{
    /**
     * @param Ad $ad
     * @return AdIsLoadedDTO
     */
    public function mapAdToDTO(Ad $ad): AdIsLoadedDTO
    {
        return new AdIsLoadedDTO(
            $ad->getId(),
            $ad->getCreated()->value()->format("Y-m-d\TH:i:s"),
            $ad->getCategory()->value(),
            $ad->getAddress()->value(),
            !empty($ad->getDescription()) ? $ad->getDescription()->value() : null,
            $ad->getPrice()->value(),
            !empty($ad->getRooms()) ? $ad->getRooms()->value() : null,
            $ad->getArea()->value(),
            !empty($ad->getFloor()) ? $ad->getFloor()->value() : null,
            $ad->getSeller(),
        );
    }
}
