<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 06.05.2017
 * Time: 11:43
 */

namespace frontend\widgets;

use common\classes\CommentsFunction;
use common\classes\Debug;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

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
                //'parent_id' => 0,
                'published' => 1
            ])
            ->orderBy('id')
            //->with('childComments')
            ->with('user')
            ->asArray()
            ->all();

        $renderView = (empty($comments)) ? 'not-comments' : 'comments';
        $cats = array();

        foreach ($comments as $item) {
            $cats[$item['parent_id']][$item['id']] =  $item;
        }


        return $this->render('comments/' . $renderView,
            [
                'comments' => CommentsFunction::buildTree($cats, 0),
                'postType' => $this->postType,
                'postId' => $this->postId,
                'pageTitle'=>$this->pageTitle
            ]
        );
    }

}