<?php

declare(strict_types=1);

namespace App\Controller\SearchAds\v1;

use App\Controller\SearchAds\v1\Input\SearchAdsDTO;
use App\Controller\SearchAds\v1\Output\AdsAreFoundDTO;

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
     * @Rest\Get("api/v1/ad")
     * @ParamConverter("searchAdsDTO", converter="fos_rest.request_body")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function searchAd(SearchAdsDTO $searchAdsDTO): Response
    {
        $result = $this->manager->searchAds($searchAdsDTO);
        $returnDTO = new AdsAreFoundDTO($result);
        $view = $this->view($returnDTO, 200);
        return $this->handleView($view);
    }
}

