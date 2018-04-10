<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.03.2018
 * Time: 22:46
 */

namespace common\models;

class Item
{
    public $name;
    public $attributes = [];
    public $content;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttribute($key)
    {
        return $this->attributes[$key];
    }

    public function delAttribute($key)
    {
        unset($this->attributes[$key]);
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function hasAttributes()
    {
        return !empty($this->attributes) ? true : false;
    }

    public function hasChildItems()
    {
        return is_array($this->content) ? true : false;
    }

    public function addChildItem($item)
    {
        $this->content[] = $item;
    }

}