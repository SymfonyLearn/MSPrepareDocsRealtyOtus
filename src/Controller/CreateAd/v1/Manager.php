<?php

declare(strict_types=1);

namespace App\Controller\CreateAd\v1;

use App\Controller\CreateAd\v1\Event\AdIsCreatedEvent;
use App\Controller\CreateAd\v1\Input\CreateAdDTO;
use App\Entity\Ad;
use App\Entity\ValueObject\AdCategory;
use App\Entity\ValueObject\Address;
use App\Entity\ValueObject\Area;
use App\Entity\ValueObject\DateCreated;
use App\Entity\ValueObject\Description;
use App\Entity\ValueObject\Floor;
use App\Entity\ValueObject\Price;
use App\Entity\ValueObject\Rooms;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Manager
{

    /**
     * @var EventDispatcherInterface
     */
    private EventDispatcherInterface $dispatcher;

    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var EntityManagerInterface $entityManager
     */
    private EntityManagerInterface $entityManager;

    /**
     * Manager constructor.
     * @param EventDispatcherInterface $dispatcher
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->dispatcher = $dispatcher;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param CreateAdDTO $createAdDTO
     * @return Ad
     */
    public function createAd(CreateAdDTO $createAdDTO): Ad
    {
        // todo Подгружать в $createAdDTO - User $seller_id (not int)?
        $seller = $this->userRepository
            ->find($createAdDTO->getSeller());
        if (!$seller) {
            throw new \InvalidArgumentException('Не существует $seller');
        }
        // todo Поля Id и DateCreated должны генерироваться автоматически
        $ad = new Ad(
            new DateCreated(new \DateTimeImmutable()),
            new AdCategory($createAdDTO->getCategory()),
            new Address($createAdDTO->getAddress()),
            new Description($createAdDTO->getDescription()),
            new Price($createAdDTO->getPrice()),
            $createAdDTO->getRooms() ? new Rooms($createAdDTO->getRooms()) : null,
            new Area($createAdDTO->getArea()),
            $createAdDTO->getFloor() ? new Floor($createAdDTO->getFloor()) : null,
            $seller
        );

        // tell Doctrine you want to (eventually) save the Entity (no queries yet)
        $this->entityManager->persist($ad);

        // actually executes the queries (i.e. the INSERT query)
        $this->entityManager->flush();

        // Создание и публикация системного события 'ad.created'
        $event = new AdIsCreatedEvent($ad);
        $this->dispatcher->dispatch($event, AdIsCreatedEvent::NAME);

        return $ad;
    }
}
