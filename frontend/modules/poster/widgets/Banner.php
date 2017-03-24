<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\modules\poster\widgets;

use common\models\db\KeyValue;
use yii\base\Widget;

class Banner extends Widget
{

    public function run()
    {

        $mainBannerPoster = KeyValue::findOne(['key' => 'main_banner_poster']);

        return $this->render('banner', [
            'mainBannerPoster' => json_decode($mainBannerPoster->value),
        ]);
    }

}