<?php

namespace frontend\modules\promotions;

use yii\helpers\Url;

/**
 * PromotionsModule module definition class
 */
class Promotions extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\promotions\controllers';

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
