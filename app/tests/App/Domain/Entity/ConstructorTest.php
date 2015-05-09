<?php
namespace UnitTest\App\Domain\Entity;

use App\Domain\ValueObject\ID;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{

    public function testGetKey()
    {
        $id = new ID(123);

        $mockEntity = $this->getMockBuilder('App\Domain\Entity\Entity')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $mockEntity->__construct($id);

        $this->assertSame('X123', $mockEntity->getKey());
    }
}
