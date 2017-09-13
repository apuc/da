<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 08.08.2017
 * Time: 14:02
 */

namespace frontend\modules\board\widgets;

use Yii;
use yii\base\Widget;

class ShowFilterTop extends Widget
{
    public $siteApi;
    public $apiKey;

    public function run()
    {
        $this->siteApi = Yii::$app->params['site-api'];
        $this->apiKey = Yii::$app->params['api-key'];

        $cat = file_get_contents($this->siteApi . '/category?parent=0');
        $region = file_get_contents($this->siteApi . '/region' . '?api_key=' . $this->apiKey);

        $get = Yii::$app->request->get();

        if(isset($get['mainCat']) && !empty($get['mainCat'])) {
            $curentCat = file_get_contents($this->siteApi . '/category/view?id=' . $get['mainCat']);
        }


        if(isset($get['regionFilter']) && !empty($get['regionFilter'])) {
            $regionName = file_get_contents($this->siteApi . '/region/view?id=' . $get['regionFilter']);
            $cityList = file_get_contents($this->siteApi . '/city?region=' . $get['regionFilter']);
        }

        if(isset($get['cityFilter']) && !empty($get['cityFilter'])) {
            $currentCity = file_get_contents($this->siteApi . '/city/view?id=' . $get['cityFilter']);
        }

        return $this->render('filter-top',
            [
                'category' => json_decode($cat),
                'region' => json_decode($region),
                'currentCategory' => (isset($curentCat)) ? json_decode($curentCat) : '',
                'currentRegion' => (isset($regionName)) ? json_decode($regionName) : '',
                'cityList' => (isset($cityList)) ? json_decode($cityList) : '',
                'currentCity' => (isset($currentCity)) ? json_decode($currentCity) : '',

                'get' => $get,
            ]
        );
    }
}