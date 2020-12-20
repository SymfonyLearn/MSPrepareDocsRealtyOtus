<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObject\DateCreated;
use App\Entity\ValueObject\DealState;

use App\Repository\DealEventRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DealEvent
 * @package App\Entity
 * @ORM\Entity(repositoryClass=DealEventRepository::class)
 */
class DealEvent
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @todo уточнить про поле, так как по докам в табл. не должно быть id?
     */
    private int $id;

    /**
     * @var Deal|null $deal
     * @ORM\ManyToOne(targetEntity=Deal::class, inversedBy="dealEvents")
     */
    private ?Deal $deal;

    /**
     * @var DateCreated $created
     * @ORM\Embedded(class="App\Entity\ValueObject\DateCreated")
     */
    private DateCreated $created;

    /**
     * @var DealState $state
     * @ORM\Embedded(class="App\Entity\ValueObject\DealState")
     */
    private DealState $state;

    /**
     * DealEvent constructor.
     * @param Deal $deal
     * @param DateCreated $created
     * @param DealState $state
     */
    public function __construct(Deal $deal, DateCreated $created, DealState $state)
    {
        $this->setDeal($deal);
        $this->setCreated($created);
        $this->setState($state);
    }

    /**
     * @return Deal|null
     */
    public function getDeal(): ?Deal
    {
        return $this->deal;
    }

    /**
     * @param Deal|null $deal
     * @return $this
     */
    public function setDeal(?Deal $deal): self
    {
        $this->deal = $deal;

        return $this;
    }

    /**
     * @param DateCreated $created
     */
    public function setCreated(DateCreated $created): void
    {
        $this->created = $created;
    }

    /**
     * @return DateCreated
     */
    public function getCreated(): DateCreated
    {
        return $this->created;
    }

    /**
     * @param DealState $state
     */
    public function setState(DealState $state): void
    {
        $this->state = $state;
    }

    /**
     * @return DealState
     */
    public function getState(): DealState
    {
        return $this->state;
    }
}
