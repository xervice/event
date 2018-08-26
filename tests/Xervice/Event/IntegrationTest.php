<?php
namespace XerviceTest\Event;

use DataProvider\EventDataProvider;
use DataProvider\TestEventDataProvider;
use Xervice\Config\Business\XerviceConfig;
use Xervice\Core\Business\Model\Locator\Dynamic\Business\DynamicBusinessLocator;
use Xervice\Core\Business\Model\Locator\Locator;
use Xervice\DataProvider\Business\DataProviderFacade;
use Xervice\DataProvider\DataProviderConfig;

require_once __DIR__ . '/TestInjection/EventDependencyProvider.php';

/**
 * @method \Xervice\Event\EventFacade getFacade()
 */
class IntegrationTest extends \Codeception\Test\Unit
{
    use DynamicBusinessLocator;

    protected function _before()
    {
        XerviceConfig::set(DataProviderConfig::FILE_PATTERN, '*.dataprovider.xml');
        $this->getDataProviderFacade()->generateDataProvider();
        XerviceConfig::set(DataProviderConfig::FILE_PATTERN, '*.testprovider.xml');
        $this->getDataProviderFacade()->generateDataProvider();
    }

    protected function _after()
    {
        $this->getDataProviderFacade()->cleanDataProvider();
    }

    /**
     * @group Xervice
     * @group Event
     * @group Integration
     */
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
     * @group Xervice
     * @group Event
     * @group Integration
     */
    public function testEventListener()
    {
        $newEvent = new TestEventDataProvider();
        $newEvent->setData('MyTestListener');

        $event = new EventDataProvider();
        $event
            ->setName('test')
            ->setMessage($newEvent);

        ob_start();
        $this->getFacade()->eventToListener($event);

        $response = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(
            'test==MyTestListener',
            $response
        );
    }

    /**
     * @return \Xervice\DataProvider\Business\DataProviderFacade
     */
    private function getDataProviderFacade(): DataProviderFacade
    {
        return Locator::getInstance()->dataProvider()->facade();
    }
}