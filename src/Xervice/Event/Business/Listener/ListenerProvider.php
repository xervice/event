<?php


namespace Xervice\Event\Business\Listener;


use DataProvider\EventDataProvider;

class ListenerProvider implements ListenerProviderInterface
{
    /**
     * @var array
     */
    private $listener;

    /**
     * ListenerProvider constructor.
     *
     * @param array $listener
     */
    public function __construct(array $listener)
    {
        $this->listener = $listener;
    }

    /**
     * @param \DataProvider\EventDataProvider $eventDataProvider
     */
    public function provideListener(EventDataProvider $eventDataProvider): void
    {
        $eventName = $eventDataProvider->getName();

        foreach ($this->getEventListenerList($eventName) as $listener) {
            $listener = $this->getEventListenerFromClass($listener);
            $listener->handleEvent($eventDataProvider);
        }
    }

    /**
     * @param string $listenerClass
     *
     * @return \Xervice\Event\Business\Listener\EventListenerInterface
     */
    private function getEventListenerFromClass(string $listenerClass): EventListenerInterface
    {
        return new $listenerClass();
    }

    /**
     * @param $eventName
     *
     * @return string[]
     */
    private function getEventListenerList(string $eventName): array
    {
        return $this->listener[$eventName] ?? [];
    }
}