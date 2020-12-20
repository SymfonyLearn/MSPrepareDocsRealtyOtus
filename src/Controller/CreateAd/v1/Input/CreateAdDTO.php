<?php

declare(strict_types=1);

namespace App\Controller\CreateAd\v1\Input;

final class CreateAdDTO
{
    /**
     * @var string Категория объявления
     */
    private string $category;

    /**
     * @var string Адрес
     */
    private string $address;

    /**
     * @var string Описание
     */
    private string $description;

    /**
     * @var int Цена
     */
    private int $price;

    /**
     * @var int|null Кол-во комнат (если применимо)
     */
    private ?int $rooms;

    /**
     * @var float Площадь, кв.м.
     */
    private float $area;

    /**
     * @var int|null Этаж (если применимо)
     */
    private ?int $floor;

    /**
     * @var int Идентификатор пользователя-продавца
     */
    private int $seller_id;

    /**
     * CreateAdDTO constructor.
     * @param  string  $category
     * @param  string  $address
     * @param  string  $description
     * @param  int  $price
     * @param  int|null  $rooms
     * @param  float  $area
     * @param  int|null  $floor
     * @param  int  $seller_id
     */
    public function __construct(
        string $category,
        string $address,
        string $description,
        int $price,
        ?int $rooms,
        float $area,
        ?int $floor,
        int $seller_id
    ) {
        $this->category = $category;
        $this->address = $address;
        $this->description = $description;
        $this->price = $price;
        $this->rooms = $rooms;
        $this->area = $area;
        $this->floor = $floor;
        $this->seller_id = $seller_id;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int|null
     */
    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    /**
     * @return float
     */
    public function getArea(): float
    {
        return $this->area;
    }

    /**
     * @return int|null
     */
    public function getFloor(): ?int
    {
        return $this->floor;
    }

    /**
     * @return int
     */
    public function getSeller(): int
    {
        return $this->seller_id;
    }

}
