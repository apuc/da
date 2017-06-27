<?php

namespace frontend\modules\board\controllers;

use common\classes\Debug;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `board` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        Debug::prn(Yii::$app->request->userIP);
        Debug::prn($_SERVER);

       /* $ads = file_get_contents(Yii::$app->params['site-api'] . '/ads/index?limit=2&expand=adsImgs,adsFieldsValues');
        $cat = file_get_contents(Yii::$app->params['site-api'] . '/category?parent=0');

        return $this->render('index',
            [
                'ads' => json_decode($ads),
                'category' => json_decode($cat),
            ]
        );*/
    }

    public function actionView($slug, $id)
    {
        $ads = file_get_contents(Yii::$app->params['site-api'] . '/ads/' . $id . '?expand=adsImgs,adsFieldsValues');

        return $this->render('view',
            [
                'ads' => json_decode($ads),
            ]
        );
    }
}
