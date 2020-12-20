<?php

declare(strict_types=1);

namespace App\Controller\DeleteAd\v1;

use App\Entity\Ad;

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
     * @Rest\Delete("api/v1/ad/{id}")
     * @IsGranted("ROLE_ADMIN")
     * @param Ad $ad
     * @return Response
     */
    public function deleteAd(Ad $ad): Response
    {
        $this->manager->deleteAd($ad);

        $view = $this->view(null, 200);

        return $this->handleView($view);
    }
}

