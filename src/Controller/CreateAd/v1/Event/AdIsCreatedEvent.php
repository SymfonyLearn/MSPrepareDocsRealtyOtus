<?php

declare(strict_types=1);

namespace App\Controller\CreateAd\v1\Event;

use App\Entity\Ad;

class AdIsCreatedEvent
{
    public const NAME = 'ad.created';

    /**
     * @var Ad
     */
    protected Ad $ad;

    /**
     * AdIsCreatedEvent constructor.
     * @param  Ad  $ad
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
    }

    /**
     * @return Ad
     */
    public function getAd(): Ad
    {
        return $this->ad;
    }
}
