<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 25.10.17
 * Time: 17:25
 */

namespace common\classes;

class CommentsFunction
{
    public static function getTree($arr)
    {
        if (count($arr) == 0 OR count($arr) == 1){
            return $arr;
        }

        return $arr;
    }

    public static function buildTree($cats, $parent_id, $only_parent = false){
        if(is_array($cats) and isset($cats[$parent_id])){
            //$tree = '';
            $tree = '';
            if($only_parent == false){

                foreach($cats[$parent_id] as $cat){
                    $tree .= "<div class=\"comment-wrapper\">";
                    $tree .= '<div class="user"><div class="user-photo">';
                    $tree .= \common\classes\UserFunction::getUser_avatar_html((!empty($cat['user_id'])) ? $cat['user_id'] : 0);
                    $tree .=  '</div></div>';

                    $tree .= '<div class="comment">
                                <div class="comment-info-wrapper">
                                    <div class="user-name">';
                                        if(!empty($cat['user']['username'])){
                                            $tree .= $cat['user']['username'];
                                        }else{
                                            $tree .= 'Гость';
                                        }

                                    $tree .= '</div>';

                    $tree .= '<div class="comment-info">';
                    if($cat['moder_checked'] == 1){
                        $tree .= '<div class="modern-comment">Выделен модератором</div>';
                    }

                    $postType = $cat['post_type'];
                    $postId = $cat['post_id'];

                    $tree .='<a data-post-type="' . $postType .'"
                           data-post-id="' . $postId . '"
                           data-parent-id="' . $cat['id'] . '" class="add-comment" href="#">Ответить</a>
                        <div class="time">';

                    $tree .= \common\classes\WordFunctions::getTimeOrDateTime($cat['dt_add']);
                    $tree .= '</div>
                    </div>
                    </div>

                    <div class="text">';
                    $tree .= $cat['content'];
                    $tree .= '</div>';
                    $tree .=  self::buildTree($cats,$cat['id']);
                    $tree .= '</div></div>';





                    /*$tree .= '
                        <div class="text">';
                            $tree .= $cat['content'];
                    $tree .= '</div>';
                    $tree .=  self::buildTree($cats,$cat['id']);
                    $tree .= '</div>';*/
                }
            }elseif(is_numeric($only_parent)){
                $cat = $cats[$parent_id][$only_parent];
                $tree .= '<li>'.$cat['content'].' #'.$cat['id'];
                $tree .=  self::buildTree($cats,$cat['id']);
                $tree .= '</li>';
            }
            //$tree .= '</>';
        }
        else return null;
        return $tree;
    }
}