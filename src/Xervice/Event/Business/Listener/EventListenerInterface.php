<?php


namespace Xervice\Event\Business\Listener;


use DataProvider\EventDataProvider;

interface EventListenerInterface
{
    /**
     * @param \DataProvider\EventDataProvider $dataProvider
     */
    public function handleEvent(EventDataProvider $dataProvider): void;
}