<?php

declare(strict_types=1);

namespace App\Controller\SearchAds\v1\Input;

final class SearchAdsDTO
{

    /**
     * @var string
     */
    public string $category;

    /**
     * @var int
     */
    public int $price_from;

    /**
     * @var int
     */
    public int $price_to;

    /**
     * @var int
     */
    public int $rooms;

    /**
     * SearchAdsDTO constructor.
     * @param  string  $category
     * @param  int  $price_from
     * @param  int  $price_to
     * @param  int  $rooms
     */
    public function __construct(string $category, int $price_from, int $price_to, int $rooms)
    {
        $this->category = $category;
        $this->price_from = $price_from;
        $this->price_to = $price_to;
        $this->rooms = $rooms;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getPriceFrom(): int
    {
        return $this->price_from;
    }

    /**
     * @return int
     */
    public function getPriceTo(): int
    {
        return $this->price_to;
    }

    /**
     * @return int
     */
    public function getRooms(): int
    {
        return $this->rooms;
    }

}
