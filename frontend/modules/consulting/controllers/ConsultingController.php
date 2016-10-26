<?php

namespace frontend\modules\consulting\controllers;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\Consulting;
use Yii;

class ConsultingController extends \yii\web\Controller {
    public function actionIndex() {
//        return $this->render('index');
        $consulting = Consulting::find()->all();

        return $this->render( 'index', [ 'consulting' => $consulting ] );
    }

    public function actionView() {
        $request = Yii::$app->request;

        $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        $company    = Company::find()->where( [ 'id' => $consulting->company_id ] )->one();

        return $this->render( 'view', [
            'consulting' => $consulting,
            'company'    => $company,
        ] );
    }

}
