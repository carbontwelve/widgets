<?php namespace Carbontwelve\Widgets;

/**
 * Class WidgetRepository
 *
 * Borrowed from https://github.com/Elendev/ElendevWidgetBundle
 *
 */
class WidgetRepository
{
	/** @var array     $widgets   An array of Widget instances */
	private $widgets = array();

	/**
	 * Register Widgets, this is called in laravel within an event
	 * so that any package can register a widget. I am using this
	 * primarily for my dashboard atm but it can be extended in many
	 * ways.
	 *
	 * @param  mixed    $service   Full namespace path to class
	 * @param  string   $method    Method of $service to be called
	 * @param  string   $tag       Name of widget
	 * @param  null|int $priority   Where in the order this widget should go
     * @return void
     */
    public function register( $service, $method, $tag, $priority = null )
	{
		$widget = new Widget( $service, $method, $tag, $priority);

		if ( ! array_key_exists( $tag, $this->widgets ) )
		{
			$this->widgets[$tag] = array();
		}

		$this->widgets[$tag][] = $widget;

		// Sort the widgets by their given priority
		usort($this->widgets[$tag], function(Widget $a, Widget $b){
            if($a->getPriority() == $b->getPriority()){
                return 0;
            }else if($a->getPriority() > $b->getPriority()){
                return -1;
            }else{
                return 1;
            }
        });
	}

	/**
	 * @throws WidgetTagNotFoundException If $tag not found as key within $this->widgets
	 * @param  string $tag       Widget group name
	 * @return array             Returns widgets associated with the $tag
	 */
	public function get( $tag )
	{
		if ( ! array_key_exists( $tag, $this->widgets ) )
		{
			throw new WidgetTagNotFoundException( 'There was not a widget group with the tag ('. $tag .')' );
		}

        return $this->widgets[$tag];
	}

	/**
	 * @return array            All widgets that have been registered
	 */
	public function all()
	{
		return $this->widgets;
	}

}

class WidgetTagNotFoundException extends \Exception{}
