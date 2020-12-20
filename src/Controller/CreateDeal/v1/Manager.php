<?php

declare(strict_types=1);

namespace App\Controller\CreateDeal\v1;

use App\Controller\CreateDeal\v1\Input\CreateDealDTO;
use App\Entity\Deal;
use App\Entity\DealEvent;
use App\Entity\ValueObject\DateCreated;
use App\Entity\ValueObject\DealState;
use App\Repository\AdRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Manager
 * @package App\Controller\CreateDeal\v1
 */
class Manager
{

    /**
     * @var UserRepository $userRepository
     */
    private UserRepository $userRepository;

    /**
     * @var AdRepository $adRepository
     */
    private AdRepository $adRepository;

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * Manager constructor.
     * @param AdRepository $adRepository
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        AdRepository $adRepository,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->adRepository = $adRepository;
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param CreateDealDTO $createDealDTO
     * @return Deal
     * @throws \Exception
     */
    public function createDeal(CreateDealDTO $createDealDTO): Deal
    {
        /*
         * Рекомендуемый подход при работе со сделками:
         * - создаём пустую сделку
         * - сразу добавляем в неё первый DealEvent со статусом "Новый"
         * - дублируем этот же статус в поле сделки
         * - сохраняем сделку в БД
         */
        // todo Подгружать в $createDealDTO - User $buyer_id (not int)?
        $buyer = $this->userRepository
            ->find($createDealDTO->getBuyer());
        if (!$buyer) {
            throw new \InvalidArgumentException('Не существует $buyer');
        }

        // todo Подгружать в $createDealDTO - Ad $ad_id (not int)?
        $ad = $this->adRepository
            ->find($createDealDTO->getAdId());
        if (!$ad) {
            throw new \InvalidArgumentException('Не существует $ad');
        }

        $dealState = new DealState('Новая');

        $deal = new Deal(
            $dealState,
            $ad,
            $buyer
        );

        $this->entityManager->getConnection()->beginTransaction(); // suspend auto-commit

        try {
            // tell Doctrine you want to (eventually) save the Entity (no queries yet)
            $this->entityManager->persist($deal);

            // actually executes the queries (i.e. the INSERT query)
            $this->entityManager->flush();

            $dealEvent = new DealEvent(
                $deal,
                new DateCreated(new \DateTimeImmutable()),
                $dealState
            );

            // tell Doctrine you want to (eventually) save the Entity (no queries yet)
            $this->entityManager->persist($dealEvent);

            // actually executes the queries (i.e. the INSERT query)
            $this->entityManager->flush();

            $this->entityManager->getConnection()->commit();
        } catch (\Exception $e) {
            $this->entityManager->getConnection()->rollBack();
            throw $e;
        }

        return $deal;
    }
}
