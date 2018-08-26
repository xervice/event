<?php


namespace Xervice\Event\Business;


use DataProvider\EventDataProvider;
use Xervice\Core\Business\Model\Facade\AbstractFacade;

/**
 * @method \Xervice\Event\Business\EventBusinessFactory getFactory()
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