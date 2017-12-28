<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 27.12.17
 * Time: 17:07
 */

namespace frontend\modules\stream\widgets;


use common\classes\Debug;
use common\models\db\VkStream;
use yii\base\Widget;

class ShowTopStream extends Widget
{
    public function run()
    {
        $model = VkStream::getPostsTop();

        foreach ($model as $item)
        {
            $item->getAllComments();
        }
        return $this->render('top-stream', ['model' => $model]);
    }
}