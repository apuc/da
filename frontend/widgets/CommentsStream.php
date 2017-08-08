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

class CommentsStream extends Widget
{

    public $pageTitle = 'Комментарии';
    public $postType = null;
    public $postId = null;

    public function run()
    {
        $renderView = 'not-comments';

        return $this->render('comments/' . $renderView,
            [
                'postType' => $this->postType,
                'postId' => $this->postId,
                'pageTitle'=>$this->pageTitle
            ]
        );
    }

}