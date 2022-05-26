<?php

namespace frontend\modules\msg\controllers;

use frontend\controllers\MainWebController;
use vision\messages\actions\MessageApiAction;

/**
 * Default controller for the `msg` module
 */
class DefaultController extends MainWebController
{
    function init()
    {
        parent::init();
    }

    public function actions()
    {
        return [
            'private-messages' => [
                'class' => MessageApiAction::className()
            ]
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionMsg()
    {

    }
}
