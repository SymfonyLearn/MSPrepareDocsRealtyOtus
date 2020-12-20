<?php

declare(strict_types=1);

namespace App\Controller\CreateDeal\v1;

use App\Controller\CreateDeal\v1\Input\CreateDealDTO;
use App\Controller\CreateDeal\v1\Output\DealIsCreatedDTO;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Rest\Post("api/v1/deal")
     * @ParamConverter("createDealDTO", converter="fos_rest.request_body")
     * @IsGranted("ROLE_USER")
     * @param CreateDealDTO $createDealDTO
     * @return Response
     */
    public function createDeal(CreateDealDTO $createDealDTO): Response
    {
        $deal = $this->manager->createDeal($createDealDTO);

        $responseDTO = new DealIsCreatedDTO($deal->getId());
        $view = $this->view($responseDTO, 200);

        return $this->handleView($view);
    }
}

