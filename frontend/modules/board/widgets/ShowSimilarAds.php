<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 27.12.17
 * Time: 10:23
 */

namespace frontend\modules\board\widgets;

use common\classes\Debug;
use frontend\modules\board\models\BoardFunction;
use Yii;
use yii\base\Widget;

class ShowSimilarAds extends Widget
{
    public $siteApi;
    public $limit;
    public $category;
    public $adsId;

    public function run()
    {
        $this->siteApi = Yii::$app->params['site-api'];
        $ads = BoardFunction::fileGetContent($this->siteApi . '/ads/similar-ads?limit=' . $this->limit . '&category='. $this->category .'&ads=' . $this->adsId . '&expand=adsImgs');


        return $this->render('similar',
            [
                'ads' => json_decode($ads)
            ]
        );
    }
}