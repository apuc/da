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
    public $view = 'share';
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


        return $this->render($this->view, ['options' => $options]);
    }

}