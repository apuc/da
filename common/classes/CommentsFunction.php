<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 25.10.17
 * Time: 17:25
 */

namespace common\classes;

use common\models\db\NewsComments;
use common\models\db\PagesComments;
use common\models\db\StockComments;
use common\models\db\VkStreamComments;

/**
 * Class CommentsFunction
 * @package common\classes
 */
class CommentsFunction
{

    public static function getCountNotModerComments()
    {
        $newsCommentsCount = NewsComments::find()->where(['verified' => 0])->count();
        $pagesCommentsCount = PagesComments::find()->where(['verified' => 0])->count();
        $vkCommentsCount = VkStreamComments::find()->where(['verified' => 0])->count();
        $stockCommentsCount = StockComments::find()->where(['verified' => 0])->count();
        $allCommentsCount = $newsCommentsCount + $pagesCommentsCount + $vkCommentsCount + $stockCommentsCount;
        return $allCommentsCount;
    }


    /**
     * @param $arr
     * @return mixed
     */
    public static function getTree($arr)
    {
        if (count($arr) == 0 OR count($arr) == 1) {
            return $arr;
        }

        return $arr;
    }

    /**
     * @param CommentsFunction $cats
     * @param int $parent_id
     * @param string $type
     * @param bool $only_parent
     * @return null|string
     */
    public static function buildTree($cats, $parent_id, $type, $only_parent = false)
    {
        if (is_array($cats) and isset($cats[$parent_id])) {
            $tree = '';
            if ($only_parent == false) {

                foreach ($cats[$parent_id] as $cat) {
                    $tree .= "<div class=\"comment-wrapper\">";
                    $tree .= '<div class="user"><div class="user-photo">';
                    $tree .= UserFunction::getUser_avatar_html((!empty($cat['user_id'])) ? $cat['user_id'] : 0);
                    $tree .= '</div></div>';

                    $tree .= '<div class="comment">
                                <div class="comment-info-wrapper">
                                    <div class="user-name">';
                    if (!empty($cat['user']['username'])) {
                        $tree .= $cat['user']['username'];
                    } else {
                        $tree .= 'Гость';
                    }

                    $tree .= '</div>';

                    $tree .= '<div class="comment-info">';
                    if ($cat['moder_checked'] == 1) {
                        $tree .= '<div class="modern-comment">Выделен модератором</div>';
                    }

                    switch ($type) {
                        case 'news':
                            $postId = $cat['news_id'];
                            break;
                        case 'page':
                            $postId = $cat['pages_id'];
                            break;
                        case 'vk_post':
                            $postId = $cat['vk_stream_id'];
                            break;
                        case 'stock':
                            $postId = $cat['stock_id'];
                            break;
                    }

                    $tree .= '<a data-post-type="' . $type . '"
                           data-post-id="' . $postId . '"
                           data-parent-id="' . $cat['id'] . '" class="add-comment" href="#">Ответить</a>
                        <div class="time">';

                    $tree .= WordFunctions::getTimeOrDateTime($cat['dt_add']);
                    $tree .= '</div>
                    </div>
                    </div>

                    <div class="text">';
                    $tree .= $cat['content'];
                    $tree .= '</div>';
                    $tree .= self::buildTree($cats, $cat['id'], $type);
                    $tree .= '</div></div>';
                }
            } elseif (is_numeric($only_parent)) {
                $cat = $cats[$parent_id][$only_parent];
                $tree .= '<li>' . $cat['content'] . ' #' . $cat['id'];
                $tree .= self::buildTree($cats, $cat['id'], $type);
                $tree .= '</li>';
            }
        } else return null;
        return $tree;
    }
}