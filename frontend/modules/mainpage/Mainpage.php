<?php

namespace frontend\modules\mainpage;
use yii\helpers\Url;

/**
 * mainpage module definition class
 */
class Mainpage extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\mainpage\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layoutPath = Url::to('@frontend/views/layouts');
        // custom initialization code goes here
    }
}
