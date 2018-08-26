<?php

namespace Xervice\Event\Business\Model\Listener;

use DataProvider\EventDataProvider;

interface ListenerProviderInterface
{
    /**
     * @param \DataProvider\EventDataProvider $eventDataProvider
     */
    public function provideListener(EventDataProvider $eventDataProvider): void;
}