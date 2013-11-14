<?php namespace Carbontwelve\Widgets\Collections;

use Illuminate\Support\Collection as BaseCollection;

class Items extends BaseCollection
{

    public function order($direction='ASC')
    {
        uasort($this->items, function($a, $b) use($direction) {
            if ($direction == 'ASC')
            {
                return $a->importance - $b->importance;
            }else{
                return $a->importance + $b->importance;
            }
        });

        return $this;
    }

    public function mergeIntoKey( $key, $value)
    {
        $this->items[$key]->merge($value);
        return $this;
    }
}
