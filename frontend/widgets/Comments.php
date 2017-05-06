<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 06.05.2017
 * Time: 11:43
 */

namespace frontend\widgets;

use common\classes\Debug;
use yii\base\Widget;

class Comments extends Widget
{

    public $pageTitle = 'Комментарии';
    public $postType = null;
    public $postId = null;

    public function run()
    {

        $comments = \common\models\db\Comments::find()
            ->where([
                'post_type' => $this->postType,
                'post_id' => $this->postId,
                'parent_id' => 0,
            ])
            ->orderBy('id DESC')
            ->with('childComments')
            ->with('user')
            ->all();

        return $this->render('comments', ['comments' => $comments]);
    }

}