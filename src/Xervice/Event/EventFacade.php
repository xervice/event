<?php


namespace Xervice\Event;


use DataProvider\EventDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \Xervice\Event\EventFactory getFactory()
 * @method \Xervice\Event\EventConfig getConfig()
 * @method \Xervice\Event\EventClient getClient()
 */
class EventFacade extends AbstractFacade
{
    /**
     * @param \DataProvider\EventDataProvider $eventDataProvider
     */
    public function fireEvent(EventDataProvider $eventDataProvider): void
    {
        $this->getFactory()->getEventProvider()->provideEvent($eventDataProvider);
    }
}