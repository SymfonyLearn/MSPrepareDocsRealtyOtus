<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\ValueObject\Email;
use App\Entity\ValueObject\UserName;
use App\Entity\ValueObject\Password;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var Email $email
     * @ORM\Embedded(class="App\Entity\ValueObject\Email")
     */
    private Email $email;

    /**
     * @var UserName $name
     * @ORM\Embedded(class="App\Entity\ValueObject\UserName")
     */
    private UserName $name;

    /**
     * @var Password $password
     * @ORM\Embedded(class="App\Entity\ValueObject\Password")
     */
    private Password $password;

    /**
     * @ORM\OneToMany(targetEntity=Ad::class, mappedBy="seller")
     */
    private $ads;

    /**
     * @ORM\OneToMany(targetEntity=Deal::class, mappedBy="buyer")
     */
    private $deals;

    /**
     * @var array Роли
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * User constructor.
     * @param Email $email
     * @param UserName $userName
     * @param Password $password
     * @param array|null $roles
     */
    public function __construct(
        // todo как получать ID для первого сохранения?
        Email $email,
        UserName $userName,
        Password $password,
        array $roles = null
    ) {
        $this->ads = new ArrayCollection();
        $this->deals = new ArrayCollection();

        // @todo откуда брать Id объекта?
        $this->id = 1;
        $this->setEmail($email);
        $this->setName($userName);
        $this->setPassword($password);

        if (!empty($roles)) {
            $this->roles = $roles;
        }
        // всегда добавляем ROLE_USER
        $roles[] = 'ROLE_USER';
        $this->roles = array_unique($roles);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Email $email
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @param UserName $userName
     */
    public function setName(UserName $userName)
    {
        $this->name = $userName;
    }

    /**
     * @return UserName
     */
    public function getName(): UserName
    {
        return $this->name;
    }

    /**
     * @param Password $password
     */
    public function setPassword(Password $password)
    {
        $this->password = $password;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * @return Collection|Ad[]
     */
    public function getAds(): Collection
    {
        return $this->ads;
    }

    public function addAd(Ad $ad): self
    {
        if (!$this->ads->contains($ad)) {
            $this->ads[] = $ad;
            $ad->setSeller($this);
        }

        return $this;
    }

    public function removeAd(Ad $ad): self
    {
        if ($this->ads->removeElement($ad)) {
            // set the owning side to null (unless already changed)
            if ($ad->getSeller() === $this) {
                $ad->setSeller(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Deal[]
     */
    public function getDeals(): Collection
    {
        return $this->deals;
    }

    public function addDeal(Deal $deal): self
    {
        if (!$this->deals->contains($deal)) {
            $this->deals[] = $deal;
            $deal->setBuyer($this);
        }

        return $this;
    }

    public function removeDeal(Deal $deal): self
    {
        if ($this->deals->removeElement($deal)) {
            // set the owning side to null (unless already changed)
            if ($deal->getBuyer() === $this) {
                $deal->setBuyer(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->getEmail();
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'email' => $this->getEmail(),
            'roles' => $this->roles,
        ];
    }
}
