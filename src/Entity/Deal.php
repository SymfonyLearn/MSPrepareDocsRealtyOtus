<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObject\DealState;
use App\Entity\ValueObject\Id;

use App\Repository\DealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Deal
 * @package App\Entity
 * @ORM\Entity(repositoryClass=DealRepository::class)
 * @todo проверить корректность типа полей (в частности null)
 */
class Deal
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var DealState $state
     * @ORM\Embedded(class="App\Entity\ValueObject\DealState")
     */
    private DealState $state;

    /**
     * @var Ad|null $ad
     * @todo как переделать на VO AdId и нужно ли?
     * @ORM\OneToOne(targetEntity=Ad::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Ad $ad;

    /**
     * @todo как переделать на VO BuyerId и нужно ли?
     * @var ?User $buyer
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="deals")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $buyer;

    /**
     * @param DealState $state
     * @param Ad $ad
     * @param User $buyer
     */
    public function __construct(
        // todo как получать ID для первого сохранения?
        DealState $state,
        Ad $ad,
        User $buyer
    ) {
        $this->setState($state);
        $this->setAdId($ad);
        $this->setBuyer($buyer);

        $this->dealEvents = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DealState
     */
    public function getState(): DealState
    {
        return $this->state;
    }

    /**
     * @param DealState $state
     * @return $this
     */
    public function setState(DealState $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Ad|null
     */
    public function getAd(): ?Ad
    {
        return $this->ad;
    }

    /**
     * @param Ad|null $ad
     * @return $this
     */
    public function setAd(?Ad $ad): self
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * @return User|null
     */
    public function getBuyer(): ?User
    {
        return $this->buyer;
    }

    /**
     * @param User|null $buyer
     * @return $this
     */
    public function setBuyer(?User $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * @return Collection|DealEvent[]
     */
    public function getDealEvents(): Collection
    {
        return $this->dealEvents;
    }

    /**
     * @param DealEvent $dealEvent
     * @return $this
     */
    public function addDealEvent(DealEvent $dealEvent): self
    {
        if (!$this->dealEvents->contains($dealEvent)) {
            $this->dealEvents[] = $dealEvent;
            $dealEvent->setDeal($this);
        }

        return $this;
    }

    /**
     * @param DealEvent $dealEvent
     * @return $this
     */
    public function removeDealEvent(DealEvent $dealEvent): self
    {
        if ($this->dealEvents->removeElement($dealEvent)) {
            // set the owning side to null (unless already changed)
            if ($dealEvent->getDeal() === $this) {
                $dealEvent->setDeal(null);
            }
        }

        return $this;
    }
}
