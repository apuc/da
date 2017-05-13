<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 13.05.2017
 * Time: 11:34
 */

namespace frontend\widgets;

use common\classes\Debug;
use yii\base\Widget;

class Share extends Widget
{

    public $url;
    public $title;
    public $description;
    public $image;

    public function run()
    {
        $options = [];
        $options['url'] = $this->url;
        $options['title'] = str_replace('"',
            "&quot;",
            preg_replace("/\s{2,}/",
                " ",
                strip_tags($this->title)
            )
        );
        $options['image'] = 'http://' . $_SERVER['HTTP_HOST'] . $this->image;

        $countSymbols = 800 - 48 - strlen($options['url']) - strlen($options['title']) - strlen($options['image']);

        $options['description'] = substr(preg_replace("/\s{2,}/", " ", strip_tags($this->description)), 0,
                $countSymbols) . '...';

        //$url = \yii\helpers\Url::base(true) . '/news/' . $new->slug;
        //$new_title = strip_tags($new->title);
        //$new_title = preg_replace("/\s{2,}/", " ", $new_title);
        //$new_title = str_replace('"', "&quot;", $new_title);
        //$new_img = 'http://' . $_SERVER['HTTP_HOST'] . $new->photo;
        //
        //
        //$count_symbols = 800 - 48 - strlen($new_url) - strlen($new_title) - strlen($new_img);
        //$new_content = strip_tags($new->content);
        //$new_content = preg_replace("/\s{2,}/", " ", $new_content);
        //
        //$new_content = substr($new_content, 0, $count_symbols) . '...';

        return $this->render('share', ['options' => $options]);
    }

}