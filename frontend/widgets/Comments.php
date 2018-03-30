<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 06.05.2017
 * Time: 11:43
 */

namespace frontend\widgets;

use common\classes\CommentsFunction;
use common\models\db\NewsComments;
use common\models\db\PagesComments;
use common\models\db\StockComments;
use common\models\db\VkStreamComments;
use yii\base\Widget;

class Comments extends Widget
{

    public $pageTitle = 'Комментарии';
    public $postType = null;
    public $postId = null;

    public function run()
    {
        switch ($this->postType) {
            case 'news':
                $query = NewsComments::find()->where([
                    'news_id' => $this->postId,
                    'published' => 1
                ]);
                break;
            case 'page':
                $query = PagesComments::find()->where([
                    'pages_id' => $this->postId,
                    'published' => 1
                ]);
                break;
            case 'vk_post':
                $query = VkStreamComments::find()->where([
                    'vk_stream_id' => $this->postId,
                    'published' => 1
                ]);
                break;
            case 'stock':
                $query = StockComments::find()->where([
                    'stock_id' => $this->postId,
                    'published' => 1
                ]);
                break;
        }

        $comments = $query
            ->orderBy('id')
            ->with('user')
            ->asArray()
            ->all();

        $renderView = (empty($comments)) ? 'not-comments' : 'comments';
        $cats = array();

        foreach ($comments as $item) {
            $cats[$item['parent_id']][$item['id']] = $item;
        }


        return $this->render('comments/' . $renderView,
            [
                'comments' => CommentsFunction::buildTree($cats, 0, $this->postType),
                'postType' => $this->postType,
                'postId' => $this->postId,
                'pageTitle' => $this->pageTitle
            ]
        );
    }

}