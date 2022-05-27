<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 29.12.17
 * Time: 10:19
 */

namespace frontend\controllers;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\KeyValue;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class DnrController extends MainWebController
{
    public $layout = 'portal';

    function init()
    {
        parent::init();
    }


    public function actionIndex()
    {
        $keyVal = KeyValue::find()->all();

        return $this->render('index',
            [
                'meta' => ArrayHelper::index($keyVal, 'key'),
            ]
        );
    }
}