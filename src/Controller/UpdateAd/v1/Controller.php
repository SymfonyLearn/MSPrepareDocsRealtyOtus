<?php

declare(strict_types=1);

namespace App\Controller\UpdateAd\v1;

use App\Controller\UpdateAd\v1\Input\UpdateAdDTO;
use App\Entity\Ad;

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
     * @Rest\Put("api/v1/ad/{id}")
     * @ParamConverter("updateAdDTO", converter="fos_rest.request_body")
     * @IsGranted("ROLE_USER")
     * @param Ad $ad
     * @param UpdateAdDTO $updateAdDTO
     * @return Response
     */
    public function createAd(Ad $ad, UpdateAdDTO $updateAdDTO): Response
    {
        $this->manager->updateAd($ad, $updateAdDTO);

        $view = $this->view(null, 200);

        return $this->handleView($view);
    }
}
