<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\News;
use yii\base\Widget;

class MainSlider extends Widget
{

    public function run()
    {

        return $this->render('main_slider', [
            'news' => News::mainSlider()->all(),
        ]);
    }

    public static function getDateNew($date)
    {
        $today = date('d.m.Y', time());
        $yesterday = date('d.m.Y', time() - 86400);
        $dbDate = date('d.m.Y', $date);

        switch ($dbDate) {
            case $today :
                $output = 'Сегодня в ' . date('H:i', $date);
                break;
            case $yesterday :
                $output = 'Вчера в ' . date('H:i', $date);
                break;
            default :
                $output = date('d.m.Y', strtotime($dbDate));//date('m.d',$dbDate);
        }
        return $output;
    }

}