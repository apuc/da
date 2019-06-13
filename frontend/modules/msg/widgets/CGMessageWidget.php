<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 11.06.19
 * Time: 15:30
 */

namespace frontend\modules\msg\widgets;


use frontend\modules\msg\components\CGMessages;
use vision\messages\assets\MessageKushalpandyaAssets;
use vision\messages\widgets\PrivateMessageKushalpandyaWidget;
use vision\messages\widgets\PrivateMessageWidget;
use Yii;

class CGMessageWidget extends PrivateMessageKushalpandyaWidget
{
    protected function getListUsers() {

        $users = CGMessages::getCurrentUsers(\Yii::$app->user->id);
        $request = Yii::$app->request;
        if($request->get('user') !== null)
        {
            $users = CGMessages::getOneUser(\Yii::$app->user->id, $request->get('user'));
        }

        $html = '<ul class="list_users message-user-list">';

        foreach($users as $usr) {
            $html .= '<li class="contact" data-user="' . $usr['id'] . '"><a href="#">';
            //$html .= '<span class="user-img"></span>';
            $html .= '<span class="user-title">' . $usr[\Yii::$app->mymessages->attributeNameUser];
            $html .= ' <span id="cnt">';
//            if($usr['cnt_mess']){
//                $html .=  $usr['cnt_mess'];
//            }
            $html .= "</span></span></a></li>";
        }
        $html .= '</ul>';
        return $html;
    }

}