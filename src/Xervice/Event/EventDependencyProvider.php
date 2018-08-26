<?php


namespace Xervice\Event;

use Xervice\Core\Business\Model\Dependency\DependencyContainerInterface;
use Xervice\Core\Business\Model\Dependency\Provider\AbstractDependencyProvider;

class EventDependencyProvider extends AbstractDependencyProvider
{
    public const LISTENER = 'listener';

    /**
     * @param \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface $container
     *
     * @return \Xervice\Core\Business\Model\Dependency\DependencyContainerInterface
     */
    public function handleDependencies(DependencyContainerInterface $container): DependencyContainerInterface
    {
        $container[self::LISTENER] = function () {
            return $this->getListener();
        };

        return $container;
    }

    /**
     * Event Listener
     * eventName => array(listener1::class, listener2::class)
     *
     * @return array
     */
    protected function getListener(): array
    {
        return [];
    }
}