<?php namespace Carbontwelve\Widgets;

/**
 * Class Widget
 *
 * Borrowed from https://github.com/orchestral/widget
 */
class WidgetManager extends \Illuminate\Support\Manager
{

    /**
     * Create Menu driver.
     *
     * @param  string   $name
     * @return Drivers\Menu
     */
    protected function createMenuDriver($name)
    {
        return new Drivers\Menu($this->app, $name);
    }

    /**
     * Create Pane driver.
     *
     * @param  string   $name
     * @return Drivers\Pane
     */
    public function createPaneDriver($name)
    {
        return new Drivers\Pane($this->app, $name);
    }

    /**
     * Create Placeholder driver.
     *
     * @param  string   $name
     * @return Drivers\Placeholder
     */
    protected function createPlaceholderDriver($name)
    {
        return new Drivers\Placeholder($this->app, $name);
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultDriver()
    {
        return 'placeholder.default';
    }

}
