<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 06.02.18
 * Time: 12:01
 */

namespace frontend\components;


use common\classes\Debug;

class ErrorAction extends \yii\web\ErrorAction
{
    /**
     * Runs the action.
     *
     * @return string result content
     */
    public function run()
    {
       $code = $this->exception->getCode();
       //Debug::prn($code);
       if(!in_array($code, [0])){
           print_r($this->exception->getMessage());
           Debug::prn($this->exception->getTraceAsString());
       }

       return parent::run();
    }
}