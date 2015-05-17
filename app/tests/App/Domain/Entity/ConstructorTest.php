<?php
namespace UnitTest\App\Domain\Entity;

use App\Domain\ValueObject\ID;
use App\Domain\ValueObject\Key;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{

    public function testGetKey()
    {
        $id = new ID(0);
        $date = new \DateTime();

        $mockEntity = $this->getMockBuilder('App\Domain\Entity\Entity')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $mockEntity->__construct($id, $date, $date);

        // full test of the key is in the key test
        $key = $mockEntity->getKey();
        $this->assertTrue($key instanceof Key);
        $this->assertSame('000000', (string) $key);
    }
}
