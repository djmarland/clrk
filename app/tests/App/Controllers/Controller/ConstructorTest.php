<?php

namespace UnitTest\App\Controllers\Controller;

use App\Domain\Entity\Settings;
use App\Domain\ValueObject\ID;
use Silex\Application;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testSetMethods()
    {
        $controller = $this->getMockBuilder('App\Controllers\Controller')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $mockService = $this->getMockBuilder('App\Service\SettingsService')
            ->disableOriginalConstructor()
            ->getMock();

        $settings = new Settings(
            new ID(1),
            1
        );

        $mockService->expects($this->once())
            ->method('get')
            ->will($this->returnValue($settings));

        $mockServiceFactory = $this->getMockBuilder('App\Infrastructure\ServiceFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $mockServiceFactory->expects($this->once())
            ->method('createService')
            ->with('Settings')
            ->will($this->returnValue($mockService));

        $controller->setServiceFactory($mockServiceFactory);

        $controller->__construct(new Application());

        $this->assertAttributeInstanceOf('App\Presenter\MasterPresenter', 'masterViewPresenter', $controller);
        $this->assertEquals($controller->get('settings'), $settings);
    }
}
