<?php

declare(strict_types=1);

namespace App\Controller\CreateAd\v1;

use App\Controller\CreateAd\v1\Input\CreateAdDTO;
use App\Controller\CreateAd\v1\Output\AdIsCreatedDTO;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractFOSRestController
{
    /**
     * @var Manager $manager
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
     * @Rest\Post("api/v1/ad")
     * @ParamConverter("createAdDTO", converter="fos_rest.request_body")
     * @IsGranted("ROLE_USER")
     * @param CreateAdDTO $createAdDTO
     * @return Response
     */
    public function createAd(CreateAdDTO $createAdDTO): Response
    {
        $ad = $this->manager->createAd($createAdDTO);

        $adIsCreatedDTO = new AdIsCreatedDTO($ad->getId());
        $view = $this->view($adIsCreatedDTO, 200);

        return $this->handleView($view);
    }
}
