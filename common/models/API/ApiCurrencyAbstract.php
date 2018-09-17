<?php


/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 16.11.2017
 * Time: 17:00
 */

namespace common\models\API;

use common\classes\Debug;
use common\models\db\Currency as DbCurrency;
use common\models\db\CurrencyRate;
use yii\base\Component;
use yii\base\InvalidConfigException;


abstract class ApiCurrencyAbstract extends Component
{
    public $errors;

    public function run()
    {
        $this->errors = [];

        $data = $this->getData();
        return $this->saveData($data);
    }

    abstract protected function fetchData();

    abstract protected function getData();

    protected function saveCoinData($id, $data)
    {
        return false;
    }

    protected function saveData($data)
    {
        if (!empty($data) && is_array($data)) {
            $ids = [];
            foreach ($data['currencies'] as $item) {
                $model = DbCurrency::findOne(['code' => $item['code']]);
                if (is_null($model)) {
                    $model = new DbCurrency();
                    $model->attributes = $item;
                    if (!$model->save())
                        $this->errors[$item['code']] = $model->getErrors();
                } else {
                    unset($item['status']);
                }
                $model->setAttributes($item);
                $model->save();
                if ($model->id) {
                    $ids[$item['code']] = $model->id;
                    if (isset($item['coin'])) $this->saveCoinData($model->id, $item['coin']);
                }
            }

            foreach ($data['rates'] as $code => $rate) {
                if (isset($ids[$code])) {
                    $rate['currency_from_id'] = $ids[$code];
                    $model = new CurrencyRate();
                    $model->attributes = $rate;
                    try {
                        if (!$model->save())
                            $this->errors[$code] = $model->getErrors();
                    } catch (InvalidConfigException $e) {
                    }
                }
            }
            return empty($this->errors);
        } else {
            return false;
        }
    }
}