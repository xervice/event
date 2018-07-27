<?php


namespace Xervice\Event;


use DataProvider\EventDataProvider;
use Xervice\Core\Facade\AbstractFacade;

/**
 * @method \Xervice\Event\EventFactory getFactory()
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

    /**
     * @param \DataProvider\EventDataProvider $eventDataProvider
     */
    public function eventToListener(EventDataProvider $eventDataProvider): void
    {
        $this->getFactory()->getListenerProvider()->provideListener($eventDataProvider);
    }
}