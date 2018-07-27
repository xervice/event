<?php


namespace Xervice\Event;


use Xervice\Core\Factory\AbstractFactory;
use Xervice\Event\Business\Provider\EventProviderInterface;

class EventFactory extends AbstractFactory
{
    /**
     * @return EventProviderInterface
     */
    public function getEventProvider(): EventProviderInterface
    {
        return $this->getDependency(EventDependencyProvider::PROVIDER);
    }
}