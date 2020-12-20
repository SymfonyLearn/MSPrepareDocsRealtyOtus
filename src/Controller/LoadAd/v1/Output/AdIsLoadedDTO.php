<?php

declare(strict_types=1);

namespace App\Controller\LoadAd\v1\Output;

use App\Entity\User;

/**
 * Class AdIsLoadedDTO
 * @package App\Controller\LoadAd\v1\Output
 */
final class AdIsLoadedDTO
{

    /**
     * @var int Идентификатор объявления
     */
    private int $id;

    /**
     * @var string Дата создания объявления
     */
    private string $created;

    /**
     * @var string Категория объявления
     */
    private string $category;

    /**
     * @var string Адрес
     */
    private string $address;

    /**
     * @var string|null Описание
     */
    private ?string $description;

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
     * @var User Идентификатор пользователя-продавца
     */
    private User $seller_id;

    /**
     * AdIsLoadedDTO constructor.
     * @param  int  $id
     * @param  string  $created
     * @param  string  $category
     * @param  string  $address
     * @param  string|null  $description
     * @param  int  $price
     * @param  int|null  $rooms
     * @param  float  $area
     * @param  int|null  $floor
     * @param  User  $seller_id
     */
    public function __construct(
        int $id,
        string $created,
        string $category,
        string $address,
        ?string $description,
        int $price,
        ?int $rooms,
        float $area,
        ?int $floor,
        User $seller_id
    ) {
        $this->id = $id;
        $this->created = $created;
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
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
     * @return string|null
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
     * @return User
     */
    public function getSeller(): User
    {
        return $this->seller_id;
    }

}
