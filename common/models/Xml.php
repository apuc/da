<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.03.2018
 * Time: 16:19
 */

namespace common\models;

class Xml
{

    public static function generate($items)
    {
        $xml = new self();
        return $xml->generateFromItems($items);
    }

    public function generateFromItems(Item $items)
    {
        $result = '<' . $items->name;
        if($items->hasAttributes()){
            foreach ($items->attributes as $key => $attribute){
                $result .= ' ' . $key . '="' . $attribute . '"';
            }
        }
        $result .= '>';
        if($items->hasChildItems()){
            foreach ((array)$items->content as $item){
                $result .= $this->generateFromItems($item);
            }
        }
        else {
            $result .= $items->getContent();
        }

        $result .= '</' . $items->name . '>';
        return $result;
    }

}