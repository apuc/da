<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 12.07.2017
 * Time: 9:50
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class MainController extends Controller
{
    function init()
    {
        parent::init();
    }

    public function beforeaction($action){
        $absoluteUrl = Yii::$app->request->absoluteUrl;
        if ((strpos($absoluteUrl, 'index.php') !== false)) {
            $scriptUrl = Yii::$app->request->scriptUrl;
            $new_url = str_replace($scriptUrl, "", $absoluteUrl);
            $this->redirect($new_url, 301);
        }
        return true;
    }
}