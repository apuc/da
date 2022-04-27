<?php

namespace backend\modules\google\controllers;

use common\classes\Debug;
use yii\web\Controller;

/**
 * Default controller for the `google` module
 */

// api key = AIzaSyA8pB7KFccjRUonbm4Uy8kJHU8ui2k_K5M
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
        return $this->render('index');
    }


}
