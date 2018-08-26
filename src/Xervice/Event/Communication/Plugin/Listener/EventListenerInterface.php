<?php
declare(strict_types=1);

namespace Xervice\Event\Communication\Plugin\Listener;

use DataProvider\EventDataProvider;

interface EventListenerInterface
{
    /**
     * @param \DataProvider\EventDataProvider $dataProvider
     */
    public function handleEvent(EventDataProvider $dataProvider): void;
}