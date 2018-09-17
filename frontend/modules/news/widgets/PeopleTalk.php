<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 15:33
 */

namespace frontend\modules\news\widgets;

use common\classes\Debug;
use common\models\db\News;
use Yii;
use yii\base\Widget;

class PeopleTalk extends Widget
{
    public $categoryId;

    public function run()
    {

        $posts = \common\models\db\PeopleTalk::find()
            ->orderBy('id DESC')
            ->limit(8)
            ->all();

        return $this->render("people_talk", [
            'posts' => $posts,
        ]);

    }

}