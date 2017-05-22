<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\widgets;

use common\models\db\KeyValue;
use common\models\db\Lang;
use yii\base\Widget;

class DayFeed extends Widget
{

    public function run()
    {
        return $this->render('day_feed', [
            'news' => \common\models\db\News::find()
                ->where(['lang_id' => Lang::getCurrent()['id'], 'status' => 0])
                ->orderBy('dt_public DESC')
                ->limit(KeyValue::findOne(['key'=>'day_feed_count'])->value)
                ->all(),
        ]);
    }

    public static function getDateNew($date)
    {
        $today = date('d.m.Y', time());
        $yesterday = date('d.m.Y', time() - 86400);
        $dbDate = date('d.m.Y', strtotime($date));

        switch ($dbDate) {
            case $today :
                $output = '';
                break;
            case $yesterday :
                $output = 'Вчера в ';
                break;
            default :
                $output = date('d.m', strtotime($dbDate));//date('m.d',$dbDate);
        }
        return $output;
    }
}