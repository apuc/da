<?php


namespace frontend\widgets;


use backend\modules\category_company\models\CategoryCompany;
use common\classes\Debug;
use common\models\db\Company;
use common\models\db\Lang;
use yii\base\Widget;

class VipCompanyWidget extends Widget
{

    public function run()
    {

        $top_company = Company::find()->where(['lang_id'=>Lang::getCurrent()['id'],'vip'=>1])->orderBy('RAND()')->limit(7)->all();
     
        return $this->render('vip_company', [
            //'category' => CategoryCompany::find()->where(['parent_id'=>0, 'lang_id'=>Lang::getCurrent()['id']])->all(),
            //'company' => \common\models\db\Company::find()->where(['lang_id'=>Lang::getCurrent()['id']])->orderBy('id DESC')->limit(7)->all(),
            'top_company' => $top_company,
        ]);
    }

}