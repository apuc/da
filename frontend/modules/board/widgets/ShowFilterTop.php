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
    public function run()
    {
        $this->siteApi = Yii::$app->params['site-api'];

        $cat = file_get_contents($this->siteApi . '/category?parent=0');
        $region = file_get_contents($this->siteApi . '/region');

        return $this->render('filter-top',
            [
                'category' => json_decode($cat),
                'region' => json_decode($region),
            ]
        );
    }
}