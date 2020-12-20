<?php

declare(strict_types=1);

namespace App\Controller\DeleteDeal\v1;

use App\Entity\Deal;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Manager
 * @package App\Controller\DeleteDeal\v1
 */
class Manager
{

    /**
     * @var EntityManagerInterface $entityManager
     */
    private EntityManagerInterface $entityManager;

    /**
     * Manager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Deal $deal
     */
    public function deleteDeal(Deal $deal): void
    {
        $this->entityManager->remove($deal);
        $this->entityManager->flush();
    }
}
