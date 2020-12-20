<?php

declare(strict_types=1);

namespace App\Controller\LoadAd\v1;

use App\Entity\Ad;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractFOSRestController
{
    /**
     * @var Mapper
     */
    private Mapper $mapper;

    /**
     * Controller constructor.
     * @param Mapper $mapper
     */
    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @Rest\Get("api/v1/ad/{id}")
     * @IsGranted("ROLE_USER")
     * @param Ad $ad
     * @return Response
     */
    public function loadAd(Ad $ad): Response
    {
        $returnDto = $this->mapper->mapAdToDTO($ad);
        $view = $this->view($returnDto, 200);

        return $this->handleView($view);
    }
}

