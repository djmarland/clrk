<?php
namespace UnitTest\App\Presenter;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    private $presenter;

    public function setUp()
    {
        $this->presenter = $this->getMockBuilder('App\Presenter\Presenter')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
    }

    public function testMergeOptions()
    {
        $this->presenter->__construct(
            null,
            [
                'mood' => 'drunk'
            ]
        );

        $this->assertEquals(
            $this->presenter->getOptions(),
            (object) [
                'classType' => 'Presenter',
                'mood' => 'drunk'
            ]
        );
    }

    public function testOverwriteOptions()
    {
        $this->presenter->__construct(
            null,
            [
                'classType' => 'PresenterTest',
                'mood' => 'sober'
            ]
        );

        $this->assertEquals(
            $this->presenter->getOptions(),
            (object) [
                'classType' => 'PresenterTest',
                'mood' => 'sober'
            ]
        );
    }

    public function testIdGeneratedOnce()
    {
        $firstId = $this->presenter->getUniqueId();
        $secondId = $this->presenter->getUniqueId();
        $this->assertSame($firstId, $secondId);
    }

    public function testIdGeneratedCorrectly()
    {
        // fetch the class name (as it differs every time it's mocked)
        $className = get_class($this->presenter);


        // seed the random number and save the value at that point
        $seed = 0;
        mt_srand($seed);
        $rand = mt_rand();

        // re-seed (so we have the same number)
        mt_srand($seed);

        $this->assertEquals(
            $this->presenter->getUniqueId(),
            'View-' . $className . '-' . $rand
        );

        // de-seed (ready for next test)
        mt_srand();
    }
}
