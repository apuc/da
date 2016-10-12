<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 05.04.2016
 * Time: 13:58
 */

namespace common\classes;


use Yii;

class UserFunction
{
    public static function hasRoles($roles, $user_id = false){
        $role = Yii::$app->authManager->getRolesByUser((!$user_id)?Yii::$app->user->getId():$user_id);
        foreach($role as $k=>$v){
            if(in_array($k,$roles)){
                return true;
            }
        }
        return false;
    }
}