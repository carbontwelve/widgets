<?php namespace Carbontwelve\Widgets;

/**
 * Class Widget
 *
 * Borrowed from https://github.com/Elendev/ElendevWidgetBundle
 */
class Widget
{

	private $service;
	private $method;
	private $tag;
	private $priority;

	public function __construct( $service, $method, $tag, $priority = null )
	{
		$this->service = $service;
        $this->method = $method;
        $this->tag = $tag;
        $this->priority = $priority;
	}

	public function setService( $service )
	{
		$this->service = $service;
	}

	public function getService()
	{
		return $this->service;
	}

	public function setMethod( $method )
	{
		$this->method = $method;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function setTag( $tag )
	{
		$this->tag = $tag;
	}

	public function getTag()
	{
		return $this->tag;
	}

	public function setPriority( $priority )
	{
		$this->priority = $priority;
	}

	public function getPriority()
	{
		return $this->priority;
	}

	public function doCall()
	{
        $handler = array($this->service, $this->method);

        if ( is_callable( $handler ) ){
		    return call_user_func_array( $handler, func_get_args() );
        }else{
            throw new ServiceNotCallableException( 'Class ('. $this->service .') is not callable.' );
        }
	}
}

class ServiceNotCallableException extends \Exception {}
