<?php

declare(strict_types=1);

namespace App\Controller\CreateDeal\v1\Input;

final class CreateDealDTO
{
    /**
     * @var int Идентификатор объявления
     */
    private int $ad_id;

    /**
     * @var int Идентификатор пользователя-покупателя
     */
    private int $buyer_id;

    /**
     * CreateAdDTO constructor.
     * @param  int  $ad_id
     * @param  int  $buyer_id
     */
    public function __construct(
        int $ad_id,
        int $buyer_id
    ) {
        $this->ad_id = $ad_id;
        $this->buyer_id = $buyer_id;
    }

    /**
     * @return int
     */
    public function getAdId(): int
    {
        return $this->ad_id;
    }

    /**
     * @return int
     */
    public function getBuyer(): int
    {
        return $this->buyer_id;
    }

}
