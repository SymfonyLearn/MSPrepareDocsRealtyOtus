<?php

declare(strict_types=1);

namespace App\Controller\DeleteAd\v1;

use App\Entity\Ad;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Manager
 * @package App\Controller\DeleteAd\v1
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
     * @param Ad $ad
     */
    public function deleteAd(Ad $ad): void
    {
        $this->entityManager->remove($ad);
        $this->entityManager->flush();
    }
}
