<?php

declare(strict_types=1);

namespace App\Consumer\CreateAdConsumer\Input;

final class Message
{

    /**
     * @var int
     */
    public int $id;

    /**
     * @var string
     */
    public string $category;

    /**
     * @var string
     */
    public string $address;

    /**
     * @var string|null
     */
    public ?string $description;

    /**
     * @var int
     */
    public int $price;

    /**
     * @var int|null
     */
    public ?int $rooms;

    /**
     * @var float
     */
    public float $area;

    /**
     * @var int|null
     */
    public ?int $floor;

    public static function createFromQueue(string $messageBody): self
    {
        $message = json_decode($messageBody, true, 512, JSON_THROW_ON_ERROR);
        $result = new self();
        $result->id = $message['id'];
        $result->category = $message['category'];
        $result->address = $message['address'];
        $result->description = $message['description'];
        $result->price = $message['price'];
        $result->rooms = $message['rooms'];
        $result->area = $message['area'];
        $result->floor = $message['floor'];
        return $result;
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
    public function getDescription(): ?string
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

}
