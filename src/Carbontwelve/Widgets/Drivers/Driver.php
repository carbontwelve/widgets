<?php namespace Carbontwelve\Widgets\Drivers;

use Closure;
use Countable;
use ArrayIterator;
use IteratorAggregate;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Carbontwelve\Widgets\Collections\Items;

/**
 *
 * Based upon the Class driver found here:
 * https://github.com/orchestral/widget/blob/master/src/Orchestra/Widget/Drivers/Driver.php
 *
 * Class Driver
 * @package Carbontwelve\Widgets\Drivers
 */
abstract class Driver implements Countable, IteratorAggregate{

    /**
     * Application instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $app = null;

    /**
     * Collection instance
     * @var \Carbontwelve\Widgets\Collections\Items
     */
    protected $collection = null;

    /**
     * Name of this instance.
     *
     * @var string
     */
    protected $name = null;

    /**
     * Widget configuration.
     *
     * @var array
     */
    protected $config = array();

    /**
     * Type of widget.
     *
     * @var string
     */
    protected $type = null;

    /**
     * Construct a new instance.
     *
     * @param  \Illuminate\Container\Container  $app
     * @param  string                           $name
     */
    public function __construct(Container $app, $name)
    {
        $this->app        = $app;
        $this->config     = array_merge(
            $this->app['config']->get("carbontwelve/widget::{$this->type}.{$name}", array()),
            $this->config
        );

        $this->name       = $name;
        $this->collection = new Items();
    }

    /**
     * Add an item to current widget.
     *
     * @param  string   $id
     * @param  \Closure $callback
     * @return mixed
     */
    abstract public function add($id, $location, $callback = null);

    /**
     * Attach item to current widget.
     *
     * @param  string   $id
     * @param  \Closure $callback
     * @return null
     */
    protected function addItem($id, $importance = 0, $callback = null)
    {
        if ($importance instanceof Closure) {
            $callback   = $importance;
            $importance = 0;
        }

        $data = new \stdClass();
        $data->importance = $importance;
        $data->value      = call_user_func($callback);

        if ($callback instanceof Closure) {
            $this->collection->put($id, $data);
        }

        $this->collection->order('ASC');
    }

    /**
     * Gets one item from the widgets collection
     *
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->collection->get($key);
    }

    /**
     * Get all items from this widgets collection
     *
     * @return array
     */
    public function getItems()
    {
        return $this->collection->all();
    }

    /**
     * Get the number of items for the current widget.
     *
     * @return integer
     */
    public function count()
    {
        return $this->collection->count();
    }

    /**
     * Get an iterator for the widgets items
     *
     * @return ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return $this->collection->getIterator();
    }

}
