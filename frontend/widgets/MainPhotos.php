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
    public $useReg;
    public function run()
    {

        if ($this->useReg == -1) {
            $useReg = null;
        }

        $photo = Photo::find()->where(['region_id' => $this->useReg])->one();
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