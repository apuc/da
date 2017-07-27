<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 19.07.2017
 * Time: 11:09
 */

namespace frontend\widgets;

use common\models\db\Company;
use yii\base\Widget;
use common\models\db\KeyValue;
use common\models\db\Stock;

class ShowRightRecommend extends Widget
{
    public function run()
    {
        $hotStock = KeyValue::findOne(['key' => 'hot_stock']);
        $model = Stock::findAll(['id' => json_decode($hotStock->value)]);

        $entertainmants = json_decode(KeyValue::findOne(['key' => 'main_entertainment'])->value);

        $entertainmantBig = $entertainmants->main_entertainments_big;


        $companyBig = Company::findOne($entertainmantBig);


        return $this->render('recommend',
            [
                'model' => $model,
                'companyBig' => $companyBig
            ]
        );
    }
}