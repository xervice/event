<?php


namespace Xervice\Event;


use Xervice\Core\Dependency\DependencyProviderInterface;
use Xervice\Core\Dependency\Provider\AbstractProvider;
use Xervice\Event\Business\Provider\DefaultEventProvider;
use Xervice\Event\Business\Provider\EventProviderInterface;

/**
 * @method \Xervice\Core\Locator\Locator getLocator()
 */
class EventDependencyProvider extends AbstractProvider
{
    public const LISTENER = 'listener';

    public const PROVIDER = 'provider';

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     */
    public function handleDependencies(DependencyProviderInterface $dependencyProvider): void
    {
        $dependencyProvider[self::LISTENER] = function () {
            return $this->getListener();
        };

        $dependencyProvider[self::PROVIDER] = function (DependencyProviderInterface $dependencyProvider) {
            return $this->getEventProvider($dependencyProvider);
        };
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

    /**
     * @param \Xervice\Core\Dependency\DependencyProviderInterface $dependencyProvider
     *
     * @return \Xervice\Event\Business\Provider\EventProviderInterface
     */
    protected function getEventProvider(DependencyProviderInterface $dependencyProvider): EventProviderInterface
    {
        return new DefaultEventProvider($this->getListener());
    }
}