<?php


namespace Xervice\Event;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\Event\Business\Listener\ListenerProvider;
use Xervice\Event\Business\Listener\ListenerProviderInterface;
use Xervice\Event\Business\Provider\DefaultEventProvider;
use Xervice\Event\Business\Provider\EventProviderInterface;

class EventFactory extends AbstractFactory
{
    private $eventProvider;

    private $listenerProvider;

    /**
     * @return \Xervice\Event\Business\Provider\EventProviderInterface
     */
    public function createEventProvider(): EventProviderInterface
    {
        return new DefaultEventProvider(
            $this->createListenerProvider()
        );
    }

    /**
     * @return \Xervice\Event\Business\Listener\ListenerProviderInterface
     */
    public function createListenerProvider(): ListenerProviderInterface
    {
        return new ListenerProvider(
            $this->getListener()
        );
    }

    /**
     * @return \Xervice\Event\Business\Provider\EventProviderInterface
     */
    public function getEventProvider(): EventProviderInterface
    {
        if ($this->eventProvider === null) {
            $this->eventProvider = $this->createEventProvider();
        }

        return $this->eventProvider;
    }

    /**
     * @return \Xervice\Event\Business\Listener\ListenerProviderInterface
     */
    public function getListenerProvider(): ListenerProviderInterface
    {
        if ($this->listenerProvider === null) {
            $this->listenerProvider = $this->createListenerProvider();
        }

        return $this->listenerProvider;
    }

    /**
     * @return array
     */
    public function getListener(): array
    {
        return $this->getDependency(EventDependencyProvider::LISTENER);
    }
}