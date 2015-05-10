<?php
namespace UnitTest\App\Service;

use App\Service\Service;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    protected $mockService;

    public function setUp()
    {
        $class = 'App\Service\Service';

        $this->mockService = $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
    }

    public function testSetFactories()
    {
        $mockFactory = 'ok';

        $this->mockService->__construct([
            Service::FACTORY_DATABASE => $mockFactory
        ]);

        $this->assertEquals($mockFactory, $this->mockService->getDatabaseQueryFactory());
    }

    /**
     * @expectedException \App\Domain\Exception\DataNotSetException
     */
    public function testFactoryMissing()
    {
        $this->mockService->getDatabaseQueryFactory();
    }
}
