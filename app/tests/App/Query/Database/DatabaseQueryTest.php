<?php
namespace UnitTest\App\Query\Database;

use App\Query\Database\Result;

class DatabaseQueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MapperInterface
     */
    private $mockMapperFactory;

    /**
     * @var DatabaseClientInterface
     */
    private $entityManager;

    private $query;

    public function setUp()
    {
        $this->mockMapperFactory = $this->getMock('App\Mapper\Database\MapperFactory');

        $this->entityManager = $this->getMock(
            '\Doctrine\ORM\EntityManager',
            [
                'getRepository',
                'getClassMetadata',
                'persist',
                'flush'
            ],
            [],
            '',
            false
        );

        $this->query = $this->getMockBuilder('App\Query\Database\DatabaseQuery')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
        $this->query->__construct($this->entityManager, $this->mockMapperFactory);
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

       // $this->query =

        $result = $this->query->getResult(['a','b','c']);
        $this->assertTrue($result instanceof Result);

        $models = $result->getDomainModels();
        $this->assertEquals(1, $models[0]);
        $this->assertEquals(2, $models[1]);
        $this->assertEquals(3, $models[2]);
    }
}
