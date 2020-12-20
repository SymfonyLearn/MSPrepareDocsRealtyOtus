<?php

declare(strict_types=1);

namespace App\EventSubscriber\CreateAdEventSubscriber;

use App\Controller\CreateAd\v1\Event\AdIsCreatedEvent;
use App\EventSubscriber\CreateAdEventSubscriber\Output\CreateAdEventDTO;
use App\Service\AsyncService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EventSubscriber implements EventSubscriberInterface
{

    /**
     * @var AsyncService
     */
    private AsyncService $asyncService;

    /**
     * EventSubscriber constructor.
     * @param  AsyncService  $asyncService
     */
    public function __construct(AsyncService $asyncService)
    {
        $this->asyncService = $asyncService;
    }

    public static function getSubscribedEvents()
    {
        return [
            AdIsCreatedEvent::NAME => 'onAdIsCreated'
        ];
    }

    public function onAdIsCreated(AdIsCreatedEvent $event)
    {
        $ad = $event->getAd();
        $message = new CreateAdEventDTO(
            $ad->getId(),
            $ad->getCategory()->value(),
            $ad->getAddress()->value(),
            !is_null($ad->getDescription()) ? $ad->getDescription()->value() : null,
            $ad->getPrice()->value(),
            !is_null($ad->getRooms()) ? $ad->getRooms()->value() : null,
            $ad->getArea()->value(),
            !is_null($ad->getFloor()) ? $ad->getFloor()->value() : null
        );
        $this->asyncService->publishToExchange(
            AsyncService::CREATE_AD,
            json_encode($message)
        );
    }
}
