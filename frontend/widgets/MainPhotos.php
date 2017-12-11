<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use common\models\db\News;
use common\models\db\Photo;
use frontend\modules\mainpage\widgets\Poster;
use Yii;
use yii\base\Widget;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class MainPhotos extends Widget
{

    public function run()
    {

        $cookies = Yii::$app->request->cookies;
        $useReg = $cookies->getValue('regionId');

        if ($useReg == -1) {
            $useReg = null;
        }

        $photo = Photo::find()->where(['region_id' => $useReg])->one();
        if (!empty($photo)){
            return $this->render('main_photos',
                [
                    'content' => $photo,
                    'photos' => explode(', ', $photo->photo),
                ]);
        }

        return false;

    }

}