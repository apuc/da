<?php

namespace frontend\modules\company\controllers;

use backend\modules\company\models\Company;
use common\classes\Debug;
use common\models\db\CategoryCompanyRelations;
use common\models\db\CompanyTariffOrder;
use common\models\db\Likes;
use common\models\db\Tariff;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `company` module
 */
class DefaultController extends Controller {
    public $layout = 'portal_page';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render( 'index' );
    }

    public function actionView() {
        $company = \common\models\db\Company::find()->where( [ 'slug' => $_GET['slug'] ] )->one();
        if ( empty( $company ) ) {
            return $this->redirect( [ 'site/error' ] );
        }
        $company->updateAllCounters( [ 'views' => 1 ], [ 'id' => $company->id ] );

        $cats_company_ids = ArrayHelper::getColumn( CategoryCompanyRelations::find()->where( [ 'company_id' => $company->id ] )->select( 'cat_id' )->asArray()->all(), 'cat_id' );
        $cats_company     = ArrayHelper::getColumn( CategoryCompanyRelations::find()->where( [ 'cat_id' => $cats_company_ids ] )->select( 'company_id' )->asArray()->all(), 'company_id' );
        $related_company  = \common\models\db\Company::find()->where( [ 'id' => $cats_company ] )->andWhere( [
            '!=',
            'id',
            $company->id
        ] )->orderBy( [ 'rand()' => SORT_DESC ] )->limit( 6 )->all();

        $most_popular_company = \common\models\db\Company::find()->andWhere( [
            '!=',
            'id',
            $company->id
        ] )->orderBy( 'views DESC' )->limit( 6 )->all();

        $count_likes   = count( Likes::find()
                                     ->where( [ 'post_type' => 'company', 'post_id' => $company->id ] )
                                     ->all() );
        $user_set_like = Likes::find()
                              ->where( [
                                  'post_type' => 'company',
                                  'user_id'   => Yii::$app->user->id,
                                  'post_id'   => $company->id,
                              ] )
                              ->one();

        return $this->render( 'view', [
            'company'              => $company,
            'related_company'      => $related_company,
            'most_popular_company' => $most_popular_company,
            'count_likes'          => $count_likes,
            'user_set_like'        => $user_set_like,
        ] );
    }

    public function actionSetTariffCompany($id)
    {
        $this->layout = "personal_area";

        $tariff = Tariff::find()->all();

        return $this->render('set-tariff',
            [
                'tariff' => $tariff,
            ]
        );
    }

    public function actionToOrder($companyId, $tariffId)
    {
        $cto = new CompanyTariffOrder;
        $cto->company_id = $companyId;
        $cto->tariff_id = $tariffId;
        $cto->save();

        return $this->redirect('success-tariff');
    }

    public function actionSuccessTariff()
    {
        $this->layout = 'personal_area';
        return $this->render('success-tariff');
    }
}
