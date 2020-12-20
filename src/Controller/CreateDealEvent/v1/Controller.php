<?php

declare(strict_types=1);

namespace App\Controller\CreateDealEvent\v1;

use App\Controller\CreateDealEvent\v1\Input\CreateDealEventDTO;
use App\Entity\Deal;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class Controller extends AbstractFOSRestController
{
    /**
     * @var Manager
     */
    private Manager $manager;

    /**
     * Controller constructor.
     * @param  Manager  $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Rest\Post("api/v1/deal/{id}")
     * @ParamConverter("createDealEventDTO", converter="fos_rest.request_body")
     * @IsGranted("ROLE_USER")
     * @param  CreateDealEventDTO  $createDealEventDTO
     */
    public function createAd(Deal $deal, CreateDealEventDTO $createDealEventDTO)
    {
        $ad = $this->manager->createDealEvent($deal, $createDealEventDTO);

        $view = $this->view(null, 200);
        return $this->handleView($view);
    }
}

