<?php

declare(strict_types=1);

namespace App\Controller\SearchAds\v1\Output;

final class AdsAreFoundDTO
{
    /**
     * @var AdIsFoundDTO[]
     */
    private array $ads;

    /**
     * AdsAreFoundDTO constructor.
     * @param  AdIsFoundDTO[]  $ads
     */
    public function __construct(array $ads)
    {
        $this->ads = $ads;
    }

    /**
     * @return AdIsFoundDTO[]
     */
    public function getAds(): array
    {
        return $this->ads;
    }
}
