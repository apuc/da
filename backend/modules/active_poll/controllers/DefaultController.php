<?php

namespace backend\modules\active_poll\controllers;

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
        if (isset($_POST['active_poll'])) {
            KeyValue::updateAll(['value' => $_POST['active_poll']], ['key' => 'active_poll']);
        }
        $key_val = KeyValue::find()->all();

        return $this->render('index', [
            'key_val' => ArrayHelper::map($key_val, 'key', 'value'),
        ]);
    }
}
