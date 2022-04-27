<?php

namespace backend\modules\rossopt\controllers;

use common\classes\Debug;
use common\models\db\KeyValue;
use common\models\db\SiteParams;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `exchange_rates` module
 */
class DefaultController extends Controller
{
    function init()
    {
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (isset($_POST['meta-title'])) {
            SiteParams::updateAll(['meta_value' => $_POST['meta-title']], ['meta_key' => 'meta-title']);
            SiteParams::updateAll(['meta_value' => $_POST['meta-descr']], ['meta_key' => 'meta-descr']);
            SiteParams::updateAll(['meta_value' => $_POST['logo']], ['meta_key' => 'logo']);
            SiteParams::updateAll(['meta_value' => $_POST['logo-text']], ['meta_key' => 'logo-text']);
            SiteParams::updateAll(['meta_value' => $_POST['mail']], ['meta_key' => 'mail']);
            SiteParams::updateAll(['meta_value' => $_POST['phones']], ['meta_key' => 'phones']);
            SiteParams::updateAll(['meta_value' => $_POST['header-banner']], ['meta_key' => 'header-banner']);
        }
        $key_val = SiteParams::find()->where(['site' => 'rossopt'])->all();

        return $this->render('index', [
            'key_val' => ArrayHelper::map($key_val, 'meta_key', 'meta_value'),
        ]);
    }
}
