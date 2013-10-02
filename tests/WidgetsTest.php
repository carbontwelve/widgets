<?php

use Carbontwelve\Widgets\WidgetRepository;
use Carbontwelve\Widgets\Widgets;
use Illuminate\Support\Facades\View;

class WidgetsTest extends PHPUnit_Framework_TestCase {

    /** @var \Carbontwelve\Widgets\WidgetRepository */
    private $widgetRepository;

    /** @var \Carbontwelve\Widgets\Widgets */
    private $widgets;

    /**
     * @return void
     */
    public static function setUpBeforeClass()
    {
        require_once __DIR__ . '/stubs/TestServices.php';
    }

    /**
     * @return void
     */
    public function tearDown(){}

    public function testInit()
    {
        $this->widgetRepository = new WidgetRepository();
        $this->widgetRepository->register( 'TestService', 'run', 'test', 1 );
        $this->assertEquals( 1, count( $this->widgetRepository->get('test') ) );

        $this->widgetRepository->register( 'TestServiceTwo', 'run', 'test', 0 );
        $this->assertEquals( 2, count( $this->widgetRepository->get('test') ) );

        $this->widgets = new Widgets( $this->widgetRepository, 'hello' );

        $testArray = array(
            'hello',
            'world!'
        );

        $this->assertEquals( $testArray, $this->widgets->display( 'test' ) );

        //$this->widgets->display( 'test' );
    }

    public function testPriority()
    {
        $this->widgetRepository = new WidgetRepository();
        $this->widgetRepository->register( 'TestService', 'run', 'test', 0 );
        $this->widgetRepository->register( 'TestServiceTwo', 'run', 'test', 1 );

        $this->widgets = new Widgets( $this->widgetRepository, 'hello' );

        $testArray = array(
            'world!',
            'hello'
        );

        $this->assertEquals( $testArray, $this->widgets->display( 'test' ) );
    }

    /**
     * Test that arguments are correctly passed through to widget classes
     */
    public function testPassedArguments()
    {
        $this->widgetRepository = new WidgetRepository();
        $this->widgetRepository->register( 'TestService', 'ret', 'test', 1 );
        $this->widgetRepository->register( 'TestServiceTwo', 'ret', 'test', 0 );

        $this->widgets = new Widgets( $this->widgetRepository, 'hello' );

        $testArray = array(
            'HELLO WORLD!',
            'hello world!'
        );

        $this->assertEquals( $testArray, $this->widgets->display( 'test', 'hello world!' ) );

        $this->widgetRepository = new WidgetRepository();
        $this->widgetRepository->register( 'TestService', 'add', 'test', 1 );
        $this->widgetRepository->register( 'TestServiceTwo', 'subtract', 'test', 0 );
        $this->widgets = new Widgets( $this->widgetRepository, 'hello' );

        $testArray = array(
            2,
            0
        );

        $this->assertEquals( $testArray, $this->widgets->display( 'test', 1, 1 ) );
    }

    public function testSetGetView()
    {
        $this->widgetRepository = new WidgetRepository();
        $this->widgets = new Widgets( $this->widgetRepository, 'hello' );

        $this->assertEquals('hello',  $this->widgets->getView());

        $this->widgets->setView('world!');
        $this->assertEquals('world!',  $this->widgets->getView());
    }


}
