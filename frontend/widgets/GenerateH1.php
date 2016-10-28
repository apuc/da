<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 29.09.2016
 * Time: 10:58
 */

namespace frontend\widgets;


use backend\modules\category_company\models\CategoryCompany;
use common\classes\Debug;
use common\models\db\CategoryNews;
use common\models\db\CategoryPoster;
use common\models\db\Poster;
use Yii;
use yii\base\Widget;

class GenerateH1 extends Widget
{

    public function run()
    {
        if (Yii::$app->controller->module->id == 'news') {
            if (Yii::$app->controller->action->id == 'category') {
                $h1 = CategoryNews::find()->where(['slug' => $_GET['slug']])->one()->title;
            }
            elseif(Yii::$app->controller->action->id == 'archive'){
                $h1 = "Архив за " . $_GET['date'];
            }
            else {
                $h1 = "Новости";
            }
        }
        elseif (Yii::$app->controller->module->id == 'company') {
            if (Yii::$app->controller->action->id == 'category') {
                $h1 = CategoryCompany::find()->where(['slug'=>$_GET['slug']])->one()->title;
            }
            else {
                $h1 = "Предприятия";
            }

        }
        elseif (Yii::$app->controller->module->id == 'poster') {
            if (Yii::$app->controller->action->id == 'view') {
                $h1 = Poster::find()->where(['slug'=>$_GET['slug']])->one()->title;
            }
            elseif(Yii::$app->controller->action->id == 'single_category'){
                $h1 = CategoryPoster::find()->where(['slug'=>$_GET['slug']])->one()->title;
            }
            else {
                $h1 = "Афиша";
            }

        }
        elseif (Yii::$app->controller->module->id == 'user') {
            if (Yii::$app->controller->action->id == 'register'){
                $h1 = "Регистрация";
            }
            elseif (Yii::$app->controller->action->id == 'login'){
                $h1 = "Вход";
            }
            elseif (Yii::$app->controller->action->id == 'request'){
                $h1 = "Восстановление пароля";
            }
            elseif (Yii::$app->controller->action->id == 'profile'){
                $h1 = "Настройки профиля";
            }
            elseif(Yii::$app->controller->action->id == 'account'){
                $h1 = "Настройки аккаунта";
            }
            else{
                $h1 = "Пользователь";
            }
        }
        elseif (Yii::$app->controller->id == 'site') {
            if(Yii::$app->controller->action->id == 'design'){
                $h1 = "Разработка";
            }
            elseif (Yii::$app->controller->action->id == 'contacts'){
                $h1 = "Контакты";
            }
            else{
                $h1 = "Сайт";
            }
        }
        elseif (Yii::$app->controller->id=='consulting'){
            if (Yii::$app->controller->action->id == 'index') {
                $h1 ='Консультации';
            }
            elseif(Yii::$app->controller->action->id == 'view'){
                $h1 ='Консалтинг';
            }
        }
        else {
            $h1 = Yii::$app->controller->id;
        }

        return $h1;
    }

}