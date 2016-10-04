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
use Yii;
use yii\base\Widget;

class GenerateH1 extends Widget
{

    public function run()
    {
        if (Yii::$app->controller->module->id == 'news') {
            if (Yii::$app->controller->action->id == 'category') {
                $h1 = CategoryNews::find()->where(['slug' => $_GET['slug']])->one()->title;
            } else {
                $h1 = "Новости";
            }
        }
        if (Yii::$app->controller->module->id == 'company') {
            if (Yii::$app->controller->action->id == 'category') {
                $h1 = CategoryCompany::find()->where(['slug'=>$_GET['slug']])->one()->title;
            }
            else {
                $h1 = "Предприятия";
            }

        } else {
            $h1 = "Новости";
        }

        return $h1;
    }

}