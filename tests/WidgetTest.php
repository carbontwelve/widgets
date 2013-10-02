<?php

use Carbontwelve\Widgets\Widget;
use Illuminate\Support\Facades\View;

class WidgetTest extends PHPUnit_Framework_TestCase {

    /** @var \Carbontwelve\Widgets\Widget */
    private $widget;

    public function testClassInit()
    {
        $this->widget = new Widget( 'TestService', 'run', 'test' );

        $this->assertEquals( 'TestService', $this->widget->getService() );
        $this->assertEquals( 'run', $this->widget->getMethod() );
        $this->assertEquals( 'test', $this->widget->getTag() );
        $this->assertEquals( null, $this->widget->getPriority() );
    }

    public function testServiceSetterGetter()
    {
        $this->widget = new Widget( 'TestService', 'run', 'test' );
        $this->assertEquals( 'TestService', $this->widget->getService() );

        $this->widget->setService( 'TestServiceTwo' );
        $this->assertEquals( 'TestServiceTwo', $this->widget->getService() );
    }

    public function testMethodSetterGetter()
    {
        $this->widget = new Widget( 'TestService', 'run', 'test' );
        $this->assertEquals( 'run', $this->widget->getMethod() );

        $this->widget->setMethod( 'run_two' );
        $this->assertEquals( 'run_two', $this->widget->getMethod() );
    }

    public function testTagSetterGetter()
    {
        $this->widget = new Widget( 'TestService', 'run', 'test' );
        $this->assertEquals( 'test', $this->widget->getTag() );

        $this->widget->setTag( 'test_two' );
        $this->assertEquals( 'test_two', $this->widget->getTag() );
    }

    public function testPrioritySetterGetter()
    {
        $this->widget = new Widget( 'TestService', 'run', 'test' );
        $this->assertEquals( null, $this->widget->getPriority() );

        $this->widget->setPriority( 0 );
        $this->assertEquals( 0, $this->widget->getPriority() );

        $this->widget->setPriority( 5 );
        $this->assertEquals( 5, $this->widget->getPriority() );

        $this->widget->setPriority( 99 );
        $this->assertEquals( 99, $this->widget->getPriority() );
    }
}
