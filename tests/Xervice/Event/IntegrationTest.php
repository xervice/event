<?php
namespace XerviceTest\Event;

use DataProvider\EventDataProvider;
use DataProvider\TestEventDataProvider;
use Xervice\Config\XerviceConfig;
use Xervice\Core\Locator\Dynamic\DynamicLocator;
use Xervice\Core\Locator\Locator;
use Xervice\DataProvider\DataProviderConfig;
use Xervice\DataProvider\DataProviderFacade;

require_once __DIR__ . '/TestInjection/EventDependencyProvider.php';

/**
 * @method \Xervice\Event\EventFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicLocator;

    protected function _before()
    {
        XerviceConfig::getInstance()->getConfig()->set(DataProviderConfig::FILE_PATTERN, '*.dataprovider.xml');
        $this->getDataProviderFacade()->generateDataProvider();
        XerviceConfig::getInstance()->getConfig()->set(DataProviderConfig::FILE_PATTERN, '*.testprovider.xml');
        $this->getDataProviderFacade()->generateDataProvider();
    }

    protected function _after()
    {
        $this->getDataProviderFacade()->cleanDataProvider();
    }

    // tests
    public function testEvent()
    {
        $newEvent = new TestEventDataProvider();
        $newEvent->setData('MyTest');

        $event = new EventDataProvider();
        $event
            ->setName('test')
            ->setMessage($newEvent);

        $eventFail = new EventDataProvider();
        $eventFail
            ->setName('testing')
            ->setMessage($newEvent);

        ob_start();
        $this->getFacade()->fireEvent($event);
        $this->getFacade()->fireEvent($eventFail);
        $this->getFacade()->fireEvent($event);

        $response = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(
            'test==MyTesttest==MyTest',
            $response
        );
    }

    /**
     * @return \Xervice\DataProvider\DataProviderFacade
     */
    private function getDataProviderFacade(): DataProviderFacade
    {
        return Locator::getInstance()->dataProvider()->facade();
    }
}