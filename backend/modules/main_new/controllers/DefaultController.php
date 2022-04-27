<?php

namespace backend\modules\main_new\controllers;

use common\classes\Debug;
use common\models\db\KeyValue;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `exchange_rates` module
 */
class DefaultController extends Controller
{

    function init()
    {
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (isset($_POST['main_new'])) {
            KeyValue::updateAll(['value' => $_POST['main_new']], ['key' => 'main_new']);
        }
        $key_val = KeyValue::find()->all();

        return $this->render('index', [
            'key_val' => ArrayHelper::map($key_val, 'key', 'value'),
        ]);
    }
}
