<?php

namespace frontend\modules\company\controllers;

use backend\modules\company\models\Company;
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
        return $this->render('view', [
            'company' => $company
        ]);
    }
}
