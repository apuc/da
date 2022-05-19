<?php

namespace frontend\widgets;

class ErrorFeedback extends \yii\base\Widget
{
    public function run()
    {
        return $this->render('error-feedback');
    }
}