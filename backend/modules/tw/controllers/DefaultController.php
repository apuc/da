<?php

namespace backend\modules\tw\controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use common\classes\Debug;
use yii\web\Controller;

/**
 * Default controller for the `tw` module
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
        $connection = new TwitterOAuth(
            'wvFJ8e9H2srypMXDcVkUB1Ebm',
            'rR21MJkF0PlmcZvnaIWrqsq2oNLpEOc2AEfOD71w4UNrMBpGkK',
            '818440355309846528-xrlDwxr1JxWrLYBFVpXuw3XPTGUiQq6',
            'GPbrt8v6nz2MJFAA0nCyuZVEdOTEAfOyFacev8r6fHuH3');

        //return $this->render('index');
        $data = $connection->get("statuses/user_timeline", array('count' => 10, 'exclude_replies' => true, 'screen_name' => 'ZloyFritz'));
        Debug::prn($data);
    }
}
