<?php

namespace frontend\modules\converter\controllers;

use common\classes\Debug;
use common\models\db\Exchange;
use common\models\db\ExchangeRates;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `converter` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = Exchange::find()->all();
        $currency = ArrayHelper::map($model, 'char_code', 'name');
        array_walk($currency, function (&$value, $key) {
            $value = $key . ' - ' . $value;
        });

        return $this->render('index', compact('currency'));
    }

    public function actionCalculate()
    {
        if (Yii::$app->request->isAjax) {
            $array = Yii::$app->request->post();
            $to = $array['toCurrency'];
            $modelFirst = Exchange::findOne(['char_code' => $to]);
            $key = $to . '_' . date('d-m-Y', time());
            Yii::$app->cache->set($key, $modelFirst, 3600);
            if ($model = Yii::$app->cache->get($key)) {
                if ($array['rub'] === 'true' && $array['fromVal'] != "NaN") {
                    $val = $array['fromVal'];
                    $res = $val * $model->nominal / $model->value;
                    $length = 2;
                    if (strlen(strval($val)) > 6){
                        $length = 0;
                    }
                    return number_format($res, $length, '.', '');
                } elseif ($array['toVal'] != "NaN") {
                    $val = $array['toVal'];
                    $res = $val * $model->value / $model->nominal;
                    $length = 2;
                    if (strlen(strval($val)) > 6){
                        $length = 0;
                    }
                    return number_format($res, $length, '.', '');
                }
            }
        }
        return false;
    }
}
