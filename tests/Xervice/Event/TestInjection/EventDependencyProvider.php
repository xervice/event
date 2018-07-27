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
                TestListener::class
            ]
        ];
    }

}