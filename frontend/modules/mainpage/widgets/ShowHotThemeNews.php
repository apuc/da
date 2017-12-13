<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 07.12.17
 * Time: 12:27
 */

namespace frontend\modules\mainpage\widgets;

use common\classes\Debug;
use common\models\db\CategoryNewsRelations;
use Yii;
use yii\base\Widget;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

class ShowHotThemeNews extends Widget
{
    public $category = '6,7';
    public function run()
    {
        $cookies = Yii::$app->request->cookies;
        $useReg = $cookies->getValue('regionId');

        $query = \common\models\db\News::find()
            ->from('news FORCE INDEX(`dt_public`)')
            ->where([ 'hot_new' => 1, 'status' => 0,])
            ->andWhere(['<=', 'dt_public', time() - 86400]);
        if($useReg != -1){
            $query->andWhere(['region_id' => NULL]);
            $query->orWhere(['region_id' => $useReg]);

        }
        $news = $query
            ->orderBy('dt_public DESC')
            ->limit(10)
            ->all();



        $newsAll = array_chunk($news, 5);

        return $this->render('hot-theme',
            [
                'newsLeft' => $newsAll[0],
                'newsRight' => $newsAll[1],
                'userReg' => $useReg,
            ]
        );
    }
}