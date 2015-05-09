<?php
namespace UnitTest\App\Query\Database;

class DatabaseQueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapperInterface
     */
    private $mockMapperFactory;

    /**
     * @var DatabaseClientInterface
     */
    private $mockClient;

    private $query;

    public function setUp()
    {
        $this->mockMapperFactory = $this->getMock('App\Mapper\Database\MapperFactory');

        $this->mockClient = $this->getMockBuilder('App\Client\Database\DatabaseClientInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->query = $this->getMockForAbstractClass('App\Query\Database\DatabaseQuery', array(
            $this->mockClient,
            $this->mockMapperFactory
        ));
    }

    public function testPagination()
    {
        $this->mockClient->expects($this->once())
            ->method('setLimit')
            ->with($this->equalTo(10));

        $this->mockClient->expects($this->once())
            ->method('setOffset')
            ->with($this->equalTo(0));

        $this->query->setPagination(10, 1);
    }

    public function testPaginationPageTwo()
    {
        $this->mockClient->expects($this->once())
            ->method('setLimit')
            ->with($this->equalTo(10));

        $this->mockClient->expects($this->once())
            ->method('setOffset')
            ->with($this->equalTo(10));

        $this->query->setPagination(10, 2);
    }

    public function testSortDefault()
    {
        $this->mockClient->expects($this->once())
            ->method('setSort')
            ->with($this->equalTo('title ASC'));

        $this->query->sortBy('title');
    }

    public function testSortDesc()
    {
        $this->mockClient->expects($this->once())
            ->method('setSort')
            ->with($this->equalTo('title DESC'));

        $this->query->sortBy('title', 'desc');
    }

    public function testInvalidSort()
    {
        $this->setExpectedException('InvalidArgumentException');
        $this->query->sortBy('title', 'upwards');
    }

    public function testGetResult()
    {
        // mapper setup
        $this->mockMapperFactory->expects($this->any())
            ->method('getDomainModel')
            ->will($this->returnCallback(function ($input) {
                $results = [
                    'a' => 1,
                    'b' => 2,
                    'c' => 3
                ];
                return $results[$input];
            }));

        // result setup
        $queryResult = $this->getMockBuilder('App\Query\Database\Result')
            ->disableOriginalConstructor()
            ->getMock();

        $queryResult->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(['a','b','c']));

        $queryResult->expects($this->once())
            ->method('setDomainModels')
            ->with([1,2,3]);

        // client setup
        $this->mockClient->expects($this->once())
            ->method('getResult')
            ->will($this->returnValue($queryResult));

        $result = $this->query->getResult();
        $this->assertEquals($result, $queryResult);
    }
}
