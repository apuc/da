<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use common\models\db\News;
use frontend\modules\mainpage\widgets\Poster;
use yii\base\Widget;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class MainPhotos extends Widget
{

    public function run()
    {

        $photosParametr = json_decode(KeyValue::find()->where(['key' => 'main_photos'])->one()->value);

        return $this->render('main_photos',
            [
                'content' => $photosParametr,
                'photos' => explode(',', $photosParametr->photos_images[0]),
            ]);
    }

}