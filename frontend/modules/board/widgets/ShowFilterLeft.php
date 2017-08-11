<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 07.08.2017
 * Time: 11:28
 */

namespace frontend\modules\board\widgets;

use common\classes\Debug;
use Yii;
use yii\base\Widget;

class ShowFilterLeft extends Widget
{   public $siteApi;

    public function run()
    {
        $this->siteApi = Yii::$app->params['site-api'];

        $get = Yii::$app->request->get();

        if(isset($get['mainCat']) && !empty($get['mainCat'])) {
            $cat = file_get_contents($this->siteApi . '/category?parent=' . $get['mainCat']);
        }

        if(isset($get['idCat']) && !empty($get['idCat'][0])) {
            $catChildren = file_get_contents($this->siteApi . '/category?parent=' . $get['idCat'][0]);
        }

        $html = '';

        if(isset($catChildren) && !empty($get['idCat'][1])) {

            $fields = file_get_contents($this->siteApi . '/category/ads-fields?id=' . $get['idCat'][1]);
            if(!empty($fields)){
                $fields = json_decode($fields);

                foreach ($fields as $item){
                    $html .= $this->render('filter_fields', ['adsFields' => $item, 'get' => $get['AdsFieldFilter']]);
                }

            }
        }

        //Debug::prn($get);
        return $this->render('ads-filter-left',
            [
                'cat' => (isset($cat)) ? json_decode($cat) : '',
                'catChildren' => (isset($catChildren)) ? json_decode($catChildren) : '',
                'adsFields' => $html,

                'get' => $get,
            ]);
    }
}