<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 15:04
 */

namespace frontend\modules\mainpage\widgets;


use backend\modules\category_company\models\CategoryCompany;
use common\models\db\Lang;
use yii\base\Widget;

class Company extends Widget
{

    public function run()
    {
        return $this->render('company', [
            'category' => CategoryCompany::find()->where(['parent_id'=>0, 'lang_id'=>Lang::getCurrent()['id']])->all(),
            'company' => \common\models\db\Company::find()->where(['lang_id'=>Lang::getCurrent()['id']])->limit(10)->all(),
        ]);
    }

}