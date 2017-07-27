<?php

namespace frontend\modules\stream\controllers;

use common\classes\Debug;
use common\models\db\VkStream;
use yii\web\Controller;

/**
 * Default controller for the `stream` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $model = VkStream::getPosts();
        //Debug::prn($model);
        return $this->render('index', ['model' => $model]);
    }
}
