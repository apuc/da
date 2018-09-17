<?php
/**
 * Created by PhpStorm.
 * User: perff
 * Date: 01.09.2017
 * Time: 17:36
 */

namespace frontend\modules\consulting\widgets;


use yii\base\Widget;

class SearchForm extends Widget
{
    public function run(){
        return $this->render('form');
    }
}