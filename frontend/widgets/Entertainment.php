<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\KeyValue;
use common\models\db\Lang;
use yii\base\Widget;

class Entertainment extends Widget
{

    public function run()
    {

        $entertainmants = json_decode(KeyValue::findOne(['key' => 'main_entertainment'])->value);
        $entertainmantSmall = $entertainmants->main_entertainments;
        $entertainmantBig = $entertainmants->main_entertainments_big;

        $companySmall = [];
        foreach ((array)$entertainmantSmall as $item) {
            $companySmall[] = Company::find()->where(['id' => $item])->with('allPhones')->one();
        }

        $companyBig =Company::find()->where(['id' => $entertainmantBig])->with('allPhones')->one();

        return $this->render('entertainment', [
            'companySmall' => $companySmall,
            'companyBig' => $companyBig,
        ]);
    }

}