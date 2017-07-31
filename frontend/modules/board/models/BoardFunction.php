<?php

namespace frontend\modules\board\models;

use common\classes\Debug;
use Yii;

class BoardFunction
{
    /**
     * Получить название категории по id
     * @param $id
     */
    public static function getCategoryById($id)
    {
        $cat = file_get_contents(Yii::$app->params['site-api'] . '/category?id=' . $id);
        Debug::prn($cat);
    }
}