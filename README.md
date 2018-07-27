Event
=====================

[![Build Status](https://travis-ci.org/xervice/event).svg?branch=master)](https://travis-ci.org/xervice/event)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/xervice/event/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/xervice/event/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/xervice/event/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/xervice/event/?branch=master)

Installation
-----------------
```
composer require xervice/event
```

Configuration
-----------------

You can fire events without configuring them. But you must define listener, to handle fired events. To do that, you have to define them in the EventDependencyProvider.

```php
<?php


namespace App\Event;


use Xervice\Event\EventDependencyProvider as XerviceEventDependencyProvider;
use XerviceTest\Event\Listener\TestListener;

class EventDependencyProvider extends XerviceEventDependencyProvider
{
    protected function getListener(): array
    {
        return [
            'test' => [
                TestListener::class //implemente EventListenerInterface
            ]
        ];
    }

}
```

If you want to change the Default Provider, you can change it also in the DependencyProvider by overwriting the method getEventProvider.
```php
    /**
     * @return \Xervice\Event\Business\Provider\EventProviderInterface
     */
    protected function getEventProvider(DependencyProviderInterface $dependencyProvider): EventProviderInterface
    {
        return new DefaultEventProvider($this->getListener());
    }
```


Using
-----------------
You can fire new Event over the event facade:
```php
    $newEventContent = new OwnDataProvider(); // DataProviderInterface
    $newEventContent->setData('MyTest');

    $event = new EventDataProvider();
    $event
        ->setName('MY_EVENT_NAME')
        ->setMessage($newEvent);

    $eventFacade->fireEvent($event);
```