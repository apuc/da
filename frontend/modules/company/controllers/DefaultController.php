<?php

namespace frontend\modules\company\controllers;

use backend\modules\company\models\Company;
use common\models\db\CategoryCompanyRelations;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `company` module
 */
class DefaultController extends Controller
{
    public $layout = 'portal_page';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView(){
        $company = \common\models\db\Company::find()->where(['slug'=>$_GET['slug']])->one();
        $company->updateAllCounters(['views'=>1], ['id'=>$company->id]);

        $cats_company_ids = ArrayHelper::getColumn(CategoryCompanyRelations::find()->where(['company_id'=>$company->id])->select('cat_id')->asArray()->all(),'cat_id');
        $cats_company = ArrayHelper::getColumn(CategoryCompanyRelations::find()->where(['cat_id'=>$cats_company_ids])->select('company_id')->asArray()->all(),'company_id');
        $related_company = \common\models\db\Company::find()->where(['id'=>$cats_company])->andWhere(['!=','id',$company->id])->orderBy(['rand()'=>SORT_DESC])->limit(3)->all();

        $most_popular_company = \common\models\db\Company::find()->andWhere(['!=','id',$company->id])->orderBy('views DESC')->limit(3)->all();


        return $this->render('view', [
            'company' => $company,
            'related_company' => $related_company,
            'most_popular_company' => $most_popular_company
        ]);
    }
}
