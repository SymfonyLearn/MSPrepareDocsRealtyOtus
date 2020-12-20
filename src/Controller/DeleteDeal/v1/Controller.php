<?php

declare(strict_types=1);

namespace App\Controller\DeleteDeal\v1;

use App\Entity\Deal;
use Doctrine\ORM\EntityManagerInterface;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractFOSRestController
{
    /**
     * @var Manager
     */
    private Manager $manager;

    /**
     * Controller constructor.
     * @param Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Rest\Delete("api/v1/deal/{id}")
     * @IsGranted("ROLE_ADMIN")
     * @param Deal $deal
     * @return Response
     */
    public function deleteAd(Deal $deal): Response
    {
        $this->manager->deleteDeal($deal);

        $view = $this->view(null, 200);

        return $this->handleView($view);
    }
}

