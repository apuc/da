<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 07.06.19
 * Time: 9:48
 */

namespace console\controllers;

use common\models\db\Faq;

use frontend\modules\news\models\NewsSearch;
use yii\console\Controller;

class BurstViewsAsksController extends Controller
{
    public $count;

    function init()
    {
        parent::init();
    }

    public function actionIndex($id = null)
    {
        if($this->count >= 5)
        {
            $this->count = random_int ( $this->count - 5 , $this->count + 5 );
        }

        $lastFaq =  Faq::find();
        if(isset($id))
        {
            $lastFaq->andFilterWhere(['id' => $id]);
        }
        $lastFaq = $lastFaq->each();

        foreach ($lastFaq as $faq)
        {
            $faq->views += $this->count;
            $faq->save();
        }
    }

    public function options($actionID)
    {
        $options = parent::options($actionID);
            $options[]= 'count';
            $options[]= 'id';

        return $options;
    }

}