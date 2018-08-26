<?php


namespace Xervice\Event\Business;


use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;
use Xervice\Event\Business\Model\Listener\ListenerProvider;
use Xervice\Event\Business\Model\Listener\ListenerProviderInterface;
use Xervice\Event\Business\Model\Provider\DefaultEventProvider;
use Xervice\Event\Business\Model\Provider\EventProviderInterface;
use Xervice\Event\EventDependencyProvider;

class EventBusinessFactory extends AbstractBusinessFactory
{
    private $eventProvider;

    private $listenerProvider;

    /**
     * @return \Xervice\Event\Business\Model\Provider\EventProviderInterface
     */
    public function createEventProvider(): EventProviderInterface
    {
        return new DefaultEventProvider(
            $this->createListenerProvider()
        );
    }

    /**
     * @return \Xervice\Event\Business\Model\Listener\ListenerProviderInterface
     */
    public function createListenerProvider(): ListenerProviderInterface
    {
        return new ListenerProvider(
            $this->getListener()
        );
    }

    /**
     * @return \Xervice\Event\Business\Model\Provider\EventProviderInterface
     */
    public function getEventProvider(): EventProviderInterface
    {
        if ($this->eventProvider === null) {
            $this->eventProvider = $this->createEventProvider();
        }

        return $this->eventProvider;
    }

    /**
     * @return \Xervice\Event\Business\Model\Listener\ListenerProviderInterface
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