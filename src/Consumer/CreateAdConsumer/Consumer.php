<?php

declare(strict_types=1);

namespace App\Consumer\CreateAdConsumer;

use App\Consumer\CreateAdConsumer\Input\Message;
use App\Consumer\CreateAdConsumer\Provider\ElasticaProvider;
use Elastica\Document;
use JsonException;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class Consumer implements ConsumerInterface
{
    /**
     * @var ElasticaProvider
     */
    private ElasticaProvider $provider;

    /**
     * Consumer constructor.
     * @param  ElasticaProvider  $provider
     */
    public function __construct(ElasticaProvider $provider)
    {
        $this->provider = $provider;
    }

    public function execute(AMQPMessage $msg)
    {
        try {
            $message = Message::createFromQueue($msg->getBody());
            $data = json_decode(json_encode($message), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return $this->reject($e->getMessage());
        }

        $document = new Document($message->getId(), $data);
        $this->provider->sendDocument($document);

        // todo Использовать логи вместо echo
        echo $message->getId();
        echo PHP_EOL;

        return self::MSG_ACK;
    }

    private function reject(string $error): int
    {
        return self::MSG_REJECT;
    }
}
