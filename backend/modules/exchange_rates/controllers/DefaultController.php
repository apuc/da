<?php

namespace backend\modules\exchange_rates\controllers;

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
        if(isset($_POST['dol'])){
            KeyValue::updateAll(['value'=>$_POST['dol']], ['key'=>'exchange_dol']);
            KeyValue::updateAll(['value'=>$_POST['euro']], ['key'=>'exchange_euro']);
            KeyValue::updateAll(['value'=>$_POST['grn']], ['key'=>'exchange_grn']);
        }
        $key_val = KeyValue::find()->all();
        return $this->render('index',[
            'key_val' => ArrayHelper::map($key_val, 'key', 'value'),
        ]);
    }
}
