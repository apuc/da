<?php

namespace backend\modules\entertainment\controllers;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\KeyValue;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `exchange_rates` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (isset($_POST['main_entertainment'])) {
            $json['main_entertainments'] = $_POST['main_entertainment'];
            $json['main_entertainments_big'] = $_POST['main_entertainments_big'];
            $main_entertainment = KeyValue::findOne(['key' => 'main_entertainment']);
            $main_entertainment->value = json_encode($json);
            $main_entertainment->save();

        }
        $key_val = KeyValue::find()->where(['key' => 'main_entertainment'])->one();
        $main_entertainment = json_decode($key_val->value);

        return $this->render('index', [
            'key_val' => ArrayHelper::map($key_val, 'key', 'value'),
            'main_entertainment' => $main_entertainment,

            'companyList' => ArrayHelper::map(Company::find()->orderBy('id DESC')->all(), 'id', 'name'),
        ]);
    }
}
