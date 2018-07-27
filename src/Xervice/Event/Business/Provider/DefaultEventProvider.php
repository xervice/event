<?php


namespace Xervice\Event\Business\Provider;


use DataProvider\EventDataProvider;

class DefaultEventProvider implements EventProviderInterface
{
    /**
     * @var \Xervice\Event\Business\Listener\ListenerProviderInterface
     */
    private $listenerProvider;

    /**
     * DefaultEventProvider constructor.
     *
     * @param \Xervice\Event\Business\Listener\ListenerProviderInterface $listenerProvider
     */
    public function __construct(\Xervice\Event\Business\Listener\ListenerProviderInterface $listenerProvider)
    {
        $this->listenerProvider = $listenerProvider;
    }

    /**
     * @param \DataProvider\EventDataProvider $eventDataProvider
     */
    public function provideEvent(EventDataProvider $eventDataProvider): void
    {
        $this->listenerProvider->provideListener($eventDataProvider);
    }
}