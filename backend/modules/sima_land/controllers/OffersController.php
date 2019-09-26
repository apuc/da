<?php


namespace backend\modules\sima_land\controllers;


class OffersController extends DefaultController
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
