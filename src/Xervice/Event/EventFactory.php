<?php


namespace Xervice\Event;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\Event\Business\Provider\EventProviderInterface;

/**
 * @method \Xervice\Event\EventConfig getConfig()
 */
class EventFactory extends AbstractFactory
{
    /**
     * @return EventProviderInterface
     */
    public function getEventProvider(): EventProviderInterface
    {
        return $this->getDependency(EventDependencyProvider::PROVIDER);
    }

    /**
     * @return array
     */
    public function getListener(): array
    {
        return $this->getDependency(EventDependencyProvider::LISTENER);
    }
}