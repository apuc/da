<?php

namespace frontend\modules\company;
use yii\helpers\Url;

/**
 * company module definition class
 */
class Company extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\company\controllers';

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
