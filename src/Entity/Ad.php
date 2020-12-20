<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObject\AdCategory;
use App\Entity\ValueObject\Address;
use App\Entity\ValueObject\Area;
use App\Entity\ValueObject\DateCreated;
use App\Entity\ValueObject\Description;
use App\Entity\ValueObject\Floor;
use App\Entity\ValueObject\Price;
use App\Entity\ValueObject\Rooms;

use App\Repository\AdRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ad
 * @package App\Entity
 * @ORM\Entity(repositoryClass=AdRepository::class)
 */
class Ad
{

    /**
     * @var int $id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var DateCreated $created
     * @ORM\Embedded(class="App\Entity\ValueObject\DateCreated")
     */
    private DateCreated $created;

    /**
     * @var AdCategory $category
     * @ORM\Embedded(class="App\Entity\ValueObject\AdCategory")
     */
    private AdCategory $category;

    /**
     * @var Address $address
     * @ORM\Embedded(class="App\Entity\ValueObject\Address")
     */
    private Address $address;

    /**
     * @var Description $description
     * @ORM\Embedded(class="App\Entity\ValueObject\Description")
     */
    private Description $description;

    /**
     * @var Price $price
     * @ORM\Embedded(class="App\Entity\ValueObject\Price")
     */
    private Price $price;
    /**
     * @var Rooms $rooms
     * @ORM\Embedded(class="App\Entity\ValueObject\Rooms")
     */
    private Rooms $rooms;

    /**
     * @var Area $area
     * @ORM\Embedded(class="App\Entity\ValueObject\Area")
     */
    private Area $area;
    /**
     * @var Floor $floor
     * @ORM\Embedded(class="App\Entity\ValueObject\Floor")
     */
    private Floor $floor;

    /**
     * @todo как переделать на VO SellerId?
     * @var ?User $seller
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ads")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $seller;

    /**
     * Ad constructor.
     * @param DateCreated $created
     * @param AdCategory $category
     * @param Address $address
     * @param Description $description
     * @param Price $price
     * @param Rooms $rooms
     * @param Area $area
     * @param Floor $floor
     * @param User $seller
     */
    public function __construct(
        // todo как получать ID для первого сохранения?
        DateCreated $created,
        AdCategory $category,
        Address $address,
        Description $description,
        Price $price,
        Rooms $rooms,
        Area $area,
        Floor $floor,
        User $seller
    ) {
        $this->setCreated($created);
        $this->setCategory($category);
        $this->setAddress($address);
        $this->setDescription($description);
        $this->setPrice($price);
        $this->setRooms($rooms);
        $this->setArea($area);
        $this->setFloor($floor);
        $this->setSeller($seller);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param DateCreated $created
     * @return self
     */
    public function setCreated(DateCreated $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return DateCreated
     */
    public function getCreated(): DateCreated
    {
        return $this->created;
    }

    /**
     * @param AdCategory $category
     * @return self
     */
    public function setCategory(AdCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return AdCategory
     */
    public function getCategory(): AdCategory
    {
        return $this->category;
    }

    /**
     * @param Address $address
     * @return self
     */
    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Description $description
     * @return $this
     */
    public function setDescription(Description $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Description
     */
    public function getDescription(): Description
    {
        return $this->description;
    }

    /**
     * @param Price $price
     * @return self
     */
    public function setPrice(Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @param Rooms $rooms
     * @return self
     */
    public function setRooms(Rooms $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * @return Rooms
     */
    public function getRooms(): Rooms
    {
        return $this->rooms;
    }

    /**
     * @param Area $area
     * @return self
     */
    public function setArea(Area $area): self
    {
        $this->area = $area;

        return $this;
    }

    /**
     * @return Area
     */
    public function getArea(): Area
    {
        return $this->area;
    }

    /**
     * @param Floor $floor
     * @return self
     */
    public function setFloor(Floor $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @return Floor
     */
    public function getFloor(): Floor
    {
        return $this->floor;
    }

    /**
     * @return \App\Entity\User|null
     */
    public function getSeller(): ?User
    {
        return $this->seller;
    }

    /**
     * @param \App\Entity\User|null $seller
     * @return $this
     */
    public function setSeller(?User $seller): self
    {
        $this->seller = $seller;

        return $this;
    }
}
