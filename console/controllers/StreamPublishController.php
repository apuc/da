<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.11.17
 * Time: 14:16
 */

namespace console\controllers;

use common\classes\Debug;
use common\models\db\GooglePlusPosts;
use common\models\db\TwPosts;
use common\models\db\VkStream;
use common\models\db\InstPhoto;
use yii\console\Controller;

class StreamPublishController extends Controller
{
    public function actionIndex()
    {
        $stream = VkStream::find()->where(['status' => 4])->orderBy('dt_publish DESC')->one();
        if(!empty($stream)){
            $stream->dt_publish = time();
            $stream->status = 1;
            $stream->save();
        }
    }

    public function actionTwitter()
    {
        $stream = TwPosts::find()->where(['status' => 4])->orderBy('dt_publish DESC')->one();
        if(!empty($stream)){
            $stream->dt_publish = time();
            $stream->status = 1;
            $stream->save();
        }
    }

    public function actionGoogle()
    {
        $stream = GooglePlusPosts::find()->where(['status' => 4])->orderBy('dt_publish DESC')->one();
        if(!empty($stream)){
            $stream->dt_publish = time();
            $stream->status = 1;
            $stream->save();
        }
    }

    public function actionInstagram()
    {
        $stream = InstPhoto::find()->where(['status' => 3])->orderBy('dt_publish DESC')->one();
        if(!empty($stream)){
            $stream->dt_publish = time();
            $stream->status = 2;
            $stream->save();
        }
    }

}