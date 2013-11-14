<?php namespace Carbontwelve\Widgets\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Classification
 * @package Carbontwelve\BloggyKernel\Facades
 * @category    Facade
 * @version     0.0.1
 * @author      Simon Dann <simon@photogabble.co.uk>
 */
class WidgetManager extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'carbontwelve.widgets';
    }

}
