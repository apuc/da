<?php

namespace frontend\modules\shop;

use yii\helpers\Url;

/**
 * shop module definition class
 */
class Shop extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\shop\controllers';

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
