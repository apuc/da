<?php

namespace backend\modules\seo\controllers;

use common\models\db\KeyValue;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `exchange_rates` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (isset($_POST['main_page_meta_title'])) {

            KeyValue::updateAll(['value' => $_POST['main_page_meta_title']], ['key' => 'main_page_meta_title']);
            KeyValue::updateAll(['value' => $_POST['main_page_meta_descr']], ['key' => 'main_page_meta_descr']);
            KeyValue::updateAll(['value' => $_POST['news_page_meta_title']], ['key' => 'news_page_meta_title']);
            KeyValue::updateAll(['value' => $_POST['news_page_meta_descr']], ['key' => 'news_page_meta_descr']);
            KeyValue::updateAll(['value' => $_POST['company_page_meta_title']], ['key' => 'company_page_meta_title']);
            KeyValue::updateAll(['value' => $_POST['company_page_meta_descr']], ['key' => 'company_page_meta_descr']);
            KeyValue::updateAll(['value' => $_POST['poster_page_meta_title']], ['key' => 'poster_page_meta_title']);
            KeyValue::updateAll(['value' => $_POST['poster_page_meta_descr']], ['key' => 'poster_page_meta_descr']);
            KeyValue::updateAll(['value' => $_POST['consulting_page_meta_title']], ['key' => 'consulting_page_meta_title']);
            KeyValue::updateAll(['value' => $_POST['consulting_page_meta_descr']], ['key' => 'consulting_page_meta_descr']);
            KeyValue::updateAll(['value' => $_POST['stream_title_page']], ['key' => 'stream_title_page']);
            KeyValue::updateAll(['value' => $_POST['stream_desc_page']], ['key' => 'stream_desc_page']);
            KeyValue::updateAll(['value' => $_POST['board_title_page']], ['key' => 'board_title_page']);
            KeyValue::updateAll(['value' => $_POST['board_desc_page']], ['key' => 'board_desc_page']);
            KeyValue::updateAll(['value' => $_POST['dnr_title_page']], ['key' => 'dnr_title_page']);
            KeyValue::updateAll(['value' => $_POST['dnr_desc_page']], ['key' => 'dnr_desc_page']);
            KeyValue::updateAll(['value' => $_POST['currency_title_page']], ['key' => 'currency_title_page']);
            KeyValue::updateAll(['value' => $_POST['currency_desc_page']], ['key' => 'currency_desc_page']);
            KeyValue::updateAll(['value' => $_POST['currency_coin_title_page']], ['key' => 'currency_coin_title_page']);
            KeyValue::updateAll(['value' => $_POST['currency_coin_desc_page']], ['key' => 'currency_coin_desc_page']);
            KeyValue::updateAll(['value' => $_POST['currency_metal_title_page']], ['key' => 'currency_metal_title_page']);
            KeyValue::updateAll(['value' => $_POST['currency_metal_desc_page']], ['key' => 'currency_metal_desc_page']);
            KeyValue::updateAll(['value' => $_POST['currency_converter_title_page']], ['key' => 'currency_converter_title_page']);
            KeyValue::updateAll(['value' => $_POST['currency_converter_desc_page']], ['key' => 'currency_converter_desc_page']);
            KeyValue::updateAll(['value' => $_POST['currency_title_all']], ['key' => 'currency_title_all']);
            KeyValue::updateAll(['value' => $_POST['currency_desc_all']], ['key' => 'currency_desc_all']);
            KeyValue::updateAll(['value' => $_POST['currency_petroleum_title_page']], ['key' => 'currency_petroleum_title_page']);
            KeyValue::updateAll(['value' => $_POST['currency_petroleum_desc_page']], ['key' => 'currency_petroleum_desc_page']);

        }
        $key_val = KeyValue::find()->all();

        return $this->render('index', [
            'key_val' => ArrayHelper::map($key_val, 'key', 'value'),
        ]);
    }
}
