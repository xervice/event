<?php


namespace Xervice\Event\Business\Model\Provider;


use DataProvider\EventDataProvider;

class DefaultEventProvider implements EventProviderInterface
{
    /**
     * @var \Xervice\Event\Business\Model\Listener\ListenerProviderInterface
     */
    private $listenerProvider;

    /**
     * DefaultEventProvider constructor.
     *
     * @param \Xervice\Event\Business\Model\Listener\ListenerProviderInterface $listenerProvider
     */
    public function __construct(\Xervice\Event\Business\Model\Listener\ListenerProviderInterface $listenerProvider)
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