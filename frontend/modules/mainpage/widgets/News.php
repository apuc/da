<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 07.09.2016
 * Time: 16:19
 */

namespace frontend\modules\mainpage\widgets;


use backend\modules\category\models\CategoryNews;
use common\classes\Debug;
use common\models\db\KeyValue;
use common\models\db\Lang;
use yii\base\Widget;

class News extends Widget {

    public function run() {

        return $this->render( 'news', [
            'cat'      => CategoryNews::find()->where( [ 'lang_id' => Lang::getCurrent()['id'] ] )->all(),
            'news'     => \common\models\db\News::find()
                                                ->where( [ 'lang_id' => Lang::getCurrent()['id'], 'status' => 0 ] )
                                                ->orderBy( 'dt_public DESC' )
                                                ->limit( 10 )
                                                ->all(),
            'main_new' => \common\models\db\News::find()
                                                ->where( [ 'id' => KeyValue::find()->where( [ 'key' => 'main_new' ] )->one()->value ] )
                                                ->one(),

        ] );
    }

    public static function getDateNew( $date ) {
        $today = date('d.m.Y', time());
        $yesterday = date('d.m.Y', time() - 86400);
        $dbDate = date('d.m.Y', strtotime($date));

        switch ($dbDate)
        {
            case $today : $output = ''; break;
            case $yesterday : $output = 'Вчера в '; break;
            default : $output = date('d.m',strtotime($dbDate));//date('m.d',$dbDate);
        }
        return $output;
    }

}