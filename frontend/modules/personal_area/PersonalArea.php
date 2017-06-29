<?php

namespace frontend\modules\personal_area;

use yii\helpers\Url;

/**
 * personal_area module definition class
 */
class PersonalArea extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\personal_area\controllers';

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
