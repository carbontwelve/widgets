<?php namespace Carbontwelve\Widgets\Drivers;

class Pane extends Driver{

    /**
     * {@inheritdoc}
     */
    protected $type = 'pane';

    /**
     * {@inheritdoc}
     */
    protected $config = array(
        'defaults' => array(
            'attributes' => array(),
            'title'      => '',
            'content'    => '',
            'html'       => '',
        ),
    );

    /**
     * {@inheritdoc}
     */
    public function add($id, $location, $callback = null)
    {
        return $this->addItem($id, $location, $callback);
    }

}
