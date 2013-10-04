<?php namespace Carbontwelve\Widgets;

use Carbontwelve\Widgets\WidgetRepository;
use Illuminate\Support\Facades\View;

/**
 * Class Widgets
 *
 * This is a container for the widgetRepository. Once the repository has been
 * initiated and widgets registered it is passed to this class via the
 * constructor. This class will be provided to the View via laravels facades
 * system and therefore can be seen as a View helper class.
 *
 * Widgets::display( 'dashboard' ); will return the rendered view of the
 * dashboard widgets. While Widgets::display( 'sidebar' ); Could return the
 * rendered view of sidebar widgets that have been registered.
 *
 * This will likely need some re-working, because I want to use this as a
 * dashboard widget helper as well as a front end widget helper and possibly
 * a sidebar widget helper for the administration. Therefore having one
 * $view for all of those will be inconvenient.
 *
 * Other usage which may be more beneficial could be to initiate this within
 * our admin base controller and pass it to the view as:
 *
 * $dashboardWidgets = $widgets;
 * $dashboardWidgets->setView('dashboard.view.path');
 * View::share('dashboard', $dashboardWidgets->display('dashboard'));
 *
 * $sidebarWidgets   = $widgets;
 * $sidebarWidgets->setView('sidebar.view.path');
 * View::share('sidebar', $sidebarWidgets->display('sidebar'));
 *
 * Not sure which I prefer or if I will come up with another way of doing this
 * with the current code base.
 *
 */
class Widgets
{
	/** @var \Carbontwelve\Widgets\WidgetRepository */
	private $widgetRepository;

	/** @var string The view file that we are going to use for rendering */
	private $view;

	public function __construct(WidgetRepository $widgetRepository, $view){
        $this->widgetRepository = $widgetRepository;
        $this->view             = $view;
    }

    public function view( $tag )
    {
        $result = $this->display( $tag );
        return View::make( $this->view, array( 'widgets' => $result ) );
    }

    public function display( $tag )
    {
		$arguments = func_get_args();
        array_shift( $arguments );
		$result    = array();

		foreach ( $this->widgetRepository->get( $tag ) as $widget )
		{
			$result[] = call_user_func_array(array($widget, "doCall"), $arguments);
		}

        return $result;
    }

    public function all()
    {
    	$result    = array();

    	foreach ( $this->widgetRepository->all() as $tag )
    	{
            if ( is_array($tag) )
            {
                foreach ($tag as $item)
                {
                    $result[$item->getTag()] = $this->display( $item->getTag() );
                }
            }else{
                $result[] = $this->display( $tag );
            }
    	}

    	return $result;
    }

    public function setView( $view )
    {
    	$this->view = $view;
    }

    public function getView()
    {
    	return $this->view;
    }
}
