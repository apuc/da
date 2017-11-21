<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 19.07.2017
 * Time: 11:09
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\Company;
use yii\base\Widget;
use common\models\db\KeyValue;
use common\models\db\Stock;

class ShowRightRecommend extends Widget
{
    public function run()
    {
       // $hotStock = KeyValue::findOne(['key' => 'hot_stock']);
        $model = Stock::find()
            ->where(['status' => 0, 'recommended' => 1])
            ->orderBy('RAND()')
            ->with('company')
            ->one();

        //Debug::prn($model);
        /*$entertainmants = json_decode(KeyValue::findOne(['key' => 'main_entertainment'])->value);

        $entertainmantBig = $entertainmants->main_entertainments_big;


        $companyBig = Company::findOne($entertainmantBig);*/


        $companyBig = Company::find()
            ->where(['status' => 0, 'recommended' => 1])
            ->orderBy('RAND()')->one();

        return $this->render('recommend',
            [
                'model' => $model,
                'companyBig' => $companyBig
            ]
        );
    }
}