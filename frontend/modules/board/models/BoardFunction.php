<?php

namespace frontend\modules\board\models;

use common\classes\Debug;
use Yii;

class BoardFunction
{
    /**
     * Получить название категории по id
     */
    public static function getCategoryById($id, $arr)
    {
        //$cat = file_get_contents(Yii::$app->params['site-api'] . '/category/view?id=' . $id);

        $category = self::fileGetContent(Yii::$app->params['site-api'] . '/category/view?id=' . $id);
        //$category = file_get_contents(Yii::$app->params['site-api'] . '/category/view?id=' . $id);

        $cat = json_decode($category);
        $arr[] = $cat;
        if($cat->parent_id != 0){
            $arr = self::getCategoryById($cat->parent_id, $arr);
        }

        //$arrEnd = array_reverse($arr);
        //Debug::prn($arr);
        return $arr;

    }

    //Получить label дополнительного поля
    public static function getLabelAdditionalField($name){
        //$label=  AdsFields::find()->where(['name' => $name])->one()->label;
        $label=  self::fileGetContent(Yii::$app->params['site-api'] . '/ads/get-label-additional-field?name=' . $name);
        //Debug::prn($label);
        return str_replace('"', '', $label);
    }

    public static function isDomainAvailible($domain)
    {
        //проверка на валидность урла
        if(!filter_var($domain, FILTER_VALIDATE_URL)){
            return false;
        }
        //инициализация curl
        $curlInit = curl_init($domain);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curlInit, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($curlInit, CURLOPT_SSL_VERIFYHOST, false);
        //получение ответа
        $response = curl_exec($curlInit);
        curl_close($curlInit);
        if ($response) return true;
        return false;
    }

    public static function fileGetContent($url)
    {

        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $response = file_get_contents($url, false, stream_context_create($arrContextOptions));

        return $response;

    }
}