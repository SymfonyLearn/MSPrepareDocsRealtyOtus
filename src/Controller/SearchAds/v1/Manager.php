<?php

declare(strict_types=1);

namespace App\Controller\SearchAds\v1;

use App\Controller\SearchAds\v1\Input\SearchAdsDTO;
use Elastica\Query;
use Elastica\Search;
use FOS\ElasticaBundle\Index\IndexManager;

/**
 * Class Manager
 * @package App\Controller\SearchAds\v1
 */
class Manager
{

    /**
     * @var IndexManager
     */
    private $indexManager;

    /**
     * @param  IndexManager  $indexManager
     */
    public function __construct(IndexManager $indexManager)
    {
        $this->indexManager = $indexManager;
    }

    public function searchAds(SearchAdsDTO $searchAdsDTO): array
    {
        $index = $this->indexManager->getIndex("app");
        $type = $index->getType("ad");
        $client = $index->getClient();
        $search = new Search($client);
        $search->addIndex("app")
            ->addType($type);

        $query = new Query([
            'query' => [
                'bool' => [
                    'should' =>
                        [
                            [
                                'term' => [
                                    'category' => $searchAdsDTO->getCategory(),
                                ],
                            ],
                            [
                                'term' => [
                                    'rooms' => $searchAdsDTO->getRooms(),
                                ],
                            ],
                            [
                                'range' => [
                                    'price' => [
                                        'gte' => $searchAdsDTO->getPriceFrom(),
                                        'lte' => $searchAdsDTO->getPriceTo()
                                    ]
                                ],
                            ]
                        ],
                ],
            ],
        ]);

        $search->setQuery($query);
        $resultSet = $search->search();

        $return = [];

        foreach ($resultSet as $item) {
            $document = $item->getDocument();
            $data = $document->getData();
            $return[] = $data;
        }

        return $return;

    }
}
