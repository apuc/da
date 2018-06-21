<?php

namespace frontend\modules\amp\controllers;

use common\models\db\News;
use yii\web\Controller;

/**
 * Default controller for the `amp` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $news = News::find()->limit(500)->orderBy('id DESC')->all();
        return $this->renderPartial('index', [
            'news' => $news
        ]);
    }
}
