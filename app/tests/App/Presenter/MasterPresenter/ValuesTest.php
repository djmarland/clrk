<?php
namespace UnitTest\App\Presenter\MasterPresenter;

use App\Presenter\MasterPresenter;

class ValuesTest extends \PHPUnit_Framework_TestCase
{
    private $presenter;

    public function setUp()
    {
        $this->presenter = new MasterPresenter();
    }

    public function testUnset()
    {
        $this->setExpectedException('App\Domain\Exception\DataNotSetException');
        $this->presenter->get('dog');
    }

    public function testValue()
    {
        $key = 'dog';
        $value = 'Destiny';
        $this->presenter->set($key, $value);
        $this->assertSame($value, $this->presenter->get($key));
    }

    public function testObjectValueIsNotTouched()
    {
        $key = 'show';
        $value = (object) [
            'title' => 'Mongrels'
        ];
        $this->presenter->set($key, $value);
        $this->assertSame($value, $this->presenter->get($key));
    }

    public function testSetGetData()
    {
        // add a value
        $this->presenter->set('fox', 'Nelson');

        // overwrite the value
        $this->presenter->set('fox', 'Vince');

        // add a non feed value
        $this->presenter->set('cat', 'Marion');

        // add a non feed value
        $this->presenter->set('pigeon', 'Kali', false);

        // get data back (alphabetical)
        $this->assertSame(
            $this->presenter->getData(),
            [
                'cat'       => 'Marion',
                'fox'       => 'Vince',
                'pigeon'    => 'Kali'
            ]
        );

        // get feed data back (alphabetical)
        $this->assertEquals(
            $this->presenter->getFeedData(),
            (object) [
                'cat' => 'Marion',
                'fox' => 'Vince'
            ]
        );
    }
}
