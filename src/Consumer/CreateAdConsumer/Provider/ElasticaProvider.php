<?php

declare(strict_types=1);

namespace App\Consumer\CreateAdConsumer\Provider;

use Elastica\Document;
use FOS\ElasticaBundle\Index\IndexManager;

class ElasticaProvider
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

    public function sendDocument(Document $document): void {
        $index = $this->indexManager->getIndex("app");
        $type = $index->getType("ad");
        $type->addDocument($document);
        $index->refresh();
    }

}
