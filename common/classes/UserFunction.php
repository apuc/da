<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 05.04.2016
 * Time: 13:58
 */

namespace common\classes;

use dektrium\user\models\Profile;
use dektrium\user\models\User;
use Yii;
use yii\helpers\Html;

class UserFunction {
    public static function hasRoles( $roles, $user_id = false ) {
        $role = Yii::$app->authManager->getRolesByUser( ( ! $user_id ) ? Yii::$app->user->getId() : $user_id );
        foreach ( $role as $k => $v ) {
            if ( in_array( $k, $roles ) ) {
                return true;
            }
        }

        return false;
    }

    public static function hasPermission( $permission, $user_id = false ) {
        $permissions = Yii::$app->authManager->getPermissionsByUser( ( ! $user_id ) ? Yii::$app->user->getId() : $user_id );
        foreach ( $permissions as $k => $v ) {
            if ( in_array( $k, $permission ) ) {
                return true;
            }
        }

        return false;
    }

    public static function getPermissionUser()
    {
        $permissions = Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id);
        if(!empty($permissions)){
            return true;
        }
        return false;
    }


    //получить аватар пользователя
    public static function getUser_avatar_url($id = null, $smal=true){
        $img = 'avatar_little';
        if(!$smal){
            $img = 'avatar';
        }

        if(empty($id)){
            $avatar = Profile::find()->where(['user_id' => Yii::$app->user->id])->one()->$img;
        }
        else{
            $avatar = Profile::find()->where(['user_id' => $id])->one()->$img;
        }

        if(empty($avatar)){
            if(!$smal){
                $avatar = '/img/default_avatar_male.jpg';
            }
            else{
                $avatar = '/img/default_avatar_little.jpg';
            }

        }

        return($avatar);
    }


    //получить аватар пользователя
    public static function getUser_avatar_html($id = null){
        if ($id == 0){
            return '<span>Г</span>' ;
        }

        $img = 'avatar';
        if(empty($id)){
            $avatar = Profile::find()->where(['user_id' => Yii::$app->user->id])->one()['avatar'];
        }
        else{
            $avatar = Profile::find()->where(['user_id' => $id])->one()['avatar'];
        }

        if(empty($avatar)){
            $username = self::getUserName($id);
            $html = '<span>' . mb_substr($username, 0,1) . '</span>' ;
        }else{
            $html = Html::img($avatar);
        }

        return $html;
    }

    public static function getUser_avatarStream(array $userInfo)
    {
        Debug::prn($userInfo);
        $html ='';

        if(!empty($userInfo['avatar'])):
            $html = '<img src="' . $userInfo['avatar'] . '" alt="">';
        else:
            $html = '<span>' . mb_substr($userInfo['username'], 0,1) . '</span>' ;
        endif;

        return $html;
    }

    //получить имя пользователя. вернет login, если имя не указано
    public static function getUserName($id = null){
        if(empty($id)){
            $name = Profile::find()->where(['user_id' => Yii::$app->user->id])->one()['name'];
            if(empty($name)){
                $name = User::find()->where(['id' => Yii::$app->user->id])->one()['username'];
            }
        }
        else{
            $name = Profile::find()->where(['user_id' => $id])->one()['name'];
            if(empty($name)){
                $name = User::find()->where(['id' => $id])->one()['username'];
            }
        }
        return $name;
    }
}