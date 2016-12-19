<?php

namespace backend\modules\seo\controllers;

use common\models\db\KeyValue;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `exchange_rates` module
 */
class DefaultController extends Controller {
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        if ( isset( $_POST['main_page_meta_title'] ) ) {

            KeyValue::updateAll( [ 'value' => $_POST['main_page_meta_title'] ], [ 'key' => 'main_page_meta_title' ] );
            KeyValue::updateAll( [ 'value' => $_POST['main_page_meta_descr'] ], [ 'key' => 'main_page_meta_descr' ] );
            KeyValue::updateAll( [ 'value' => $_POST['news_page_meta_title'] ], [ 'key' => 'news_page_meta_title' ] );
            KeyValue::updateAll( [ 'value' => $_POST['news_page_meta_descr'] ], [ 'key' => 'news_page_meta_descr' ] );
            KeyValue::updateAll( [ 'value' => $_POST['company_page_meta_title'] ], [ 'key' => 'company_page_meta_title' ] );
            KeyValue::updateAll( [ 'value' => $_POST['company_page_meta_descr'] ], [ 'key' => 'company_page_meta_descr' ] );
            KeyValue::updateAll( [ 'value' => $_POST['poster_page_meta_title'] ], [ 'key' => 'poster_page_meta_title' ] );
            KeyValue::updateAll( [ 'value' => $_POST['poster_page_meta_descr'] ], [ 'key' => 'poster_page_meta_descr' ] );
            KeyValue::updateAll( [ 'value' => $_POST['consulting_page_meta_title'] ], [ 'key' => 'consulting_page_meta_title' ] );
            KeyValue::updateAll( [ 'value' => $_POST['consulting_page_meta_descr'] ], [ 'key' => 'consulting_page_meta_descr' ] );

        }
        $key_val = KeyValue::find()->all();

        return $this->render( 'index', [
            'key_val' => ArrayHelper::map( $key_val, 'key', 'value' ),
        ] );
    }
}
