<?php

namespace UnitTest\App\Controllers\Controller;

use App\Presenter\MasterPresenter;
use Silex\Application;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testSetMethods()
    {
        $controller = $this->getMockForAbstractClass('App\Controllers\Controller');

        $this->assertAttributeEquals(new MasterPresenter(), 'masterViewPresenter', $controller);
    }
}
