<?php


namespace Xervice\Event\Business\Provider;


use DataProvider\EventDataProvider;

interface EventProviderInterface
{
    /**
     * @param \DataProvider\EventDataProvider $eventDataProvider
     */
    public function provideEvent(EventDataProvider $eventDataProvider): void;
}