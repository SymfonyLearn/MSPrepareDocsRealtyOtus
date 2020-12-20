<?php

declare(strict_types=1);

namespace App\EventSubscriber\CreateAdEventSubscriber\Output;

final class CreateAdEventDTO
{
    public int $id;

    public string $category;

    public string $address;

    public ?string $description;

    public int $price;

    public ?int $rooms;

    public float $area;

    public ?int $floor;

    /**
     * CreateAdEventDTO constructor.
     * @param  int  $id
     * @param  string  $category
     * @param  string  $address
     * @param  string|null  $description
     * @param  int  $price
     * @param  int|null  $rooms
     * @param  float  $area
     * @param  int|null  $floor
     */
    public function __construct(
        int $id,
        string $category,
        string $address,
        ?string $description,
        int $price,
        ?int $rooms,
        float $area,
        ?int $floor
    ) {
        $this->id = $id;
        $this->category = $category;
        $this->address = $address;
        $this->description = $description;
        $this->price = $price;
        $this->rooms = $rooms;
        $this->area = $area;
        $this->floor = $floor;
    }

}
