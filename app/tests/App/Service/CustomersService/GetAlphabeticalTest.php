<?php
namespace UnitTest\App\Service\CustomerService;

use App\Domain\Entity\Customer;
use App\Client\Database\DatabaseClient;
use App\Query\Database\DatabaseQuery;
use App\Service\CustomersService;
use App\Infrastructure\ServiceFactory;
use App\Service\Service;

class GetAlphabeticalTest extends \PHPUnit_Framework_TestCase
{
    protected $mockCustomersQuery;

    protected $mockDatabaseQueryFactory;

    protected $mockDatabaseResult;

    public function setUp()
    {
        $this->mockCustomersQuery = $this->getMockBuilder('App\Query\Database\CustomersQuery')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockDatabaseQueryFactory = $this->getMockBuilder('App\Query\DatabaseQueryFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockDatabaseQueryFactory->expects($this->once())
            ->method('createQuery')
            ->with($this->equalTo('Customers'))
            ->will($this->returnValue($this->mockCustomersQuery));

        $this->mockDatabaseResult = $this->getMockBuilder('App\Query\Database\Result')
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockCustomersQuery->expects($this->once())->method('sortAlphabetically');

    }

    public function testDefaultParams()
    {
        $this->mockCustomersQuery->expects($this->once())->method('setPagination')->with(
            DatabaseQuery::DEFAULT_PAGESIZE,
            DatabaseQuery::DEFAULT_PAGE
        );

        $this->mockDatabaseResult->expects($this->once())
            ->method('getDomainModels')
            ->will($this->returnValue([1]));

        $this->mockCustomersQuery->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue($this->mockDatabaseResult));

        $customersService = new CustomersService([
            Service::FACTORY_DATABASE => $this->mockDatabaseQueryFactory
        ]);

        $customers = $customersService->getAlphabetical();
        $this->assertEquals([1], $customers->getDomainModels());
    }

    public function testPaginationParams()
    {
        $this->mockCustomersQuery->expects($this->once())->method('setPagination')->with(
            10,
            2
        );

        $this->mockDatabaseResult->expects($this->once())
            ->method('getDomainModels')
            ->will($this->returnValue([2]));

        $this->mockCustomersQuery->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue($this->mockDatabaseResult));

        $customersService = new CustomersService([
            'Database' => $this->mockDatabaseQueryFactory
        ]);

        $customers = $customersService->getAlphabetical(10, 2);
        $this->assertEquals([2], $customers->getDomainModels());
    }
}
