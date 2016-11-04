<?php

namespace frontend\modules\consulting\controllers;

use common\classes\Debug;
use common\models\db\CategoryFaq;
use common\models\db\CategoryPostsConsulting;
use common\models\db\CategoryPostsDigest;
use common\models\db\Company;
use common\models\db\Consulting;
use Yii;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

class ConsultingController extends \yii\web\Controller {
    public function actionIndex() {
//        return $this->render('index');
        $consulting = Consulting::find()->all();

        return $this->render( 'index', [ 'consulting' => $consulting ] );
    }

    public function actionView() {
        $request = Yii::$app->request;

        $consulting        = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        $company           = Company::find()->where( [ 'id' => $consulting->company_id ] )->one();
       // $categories_faq    = CategoryFaq::find()->where( [ 'type' => $consulting->slug ] )->all();
        $db                = new Connection(Yii::$app->db );//Connection( );
        $categories_faq       = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `faq` WHERE cat_id = category_faq.id) AS memberCount FROM `category_faq` as category_faq WHERE category_faq.type = '$consulting->slug'
        " )->queryAll();
        
        $categories_posts  = CategoryPostsConsulting::find()->where( [ 'type' => $consulting->slug ] )->all();
        $categories_digest = CategoryPostsDigest::find()->where( [ 'type' => $consulting->slug ] )->all();

        return $this->render( 'view', [
            'consulting'        => $consulting,
            'company'           => $company,
            'categories_faq'    => $categories_faq,
            'categories_posts'  => $categories_posts,
            'categories_digest' => $categories_digest,
        ] );
    }
    
}
