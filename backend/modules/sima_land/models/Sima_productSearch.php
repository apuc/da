<?php


namespace backend\modules\sima_land\models;


use backend\modules\sima_land\components\SimaLand;
use yii\data\ArrayDataProvider;

class Sima_productSearch
{
    public $category_id = null;

    public function rules()
    {
        return [
          [['category_id'], 'integer'],
        ];
    }

    public function search($params)
    {
        $response = SimaLand::load('item', $this->category_id);
        $provider = new ArrayDataProvider([
            'allModels' => $response['items'],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $provider;
    }
}