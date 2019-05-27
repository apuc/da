<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 01.04.2017
 * Time: 12:22
 */

namespace frontend\modules\consulting\widgets;

use common\classes\Debug;
use common\models\db\Faq;
use yii\base\Widget;

class LastFaq extends Widget
{
    public function run()
    {
        $lastFaq = Faq::find()
            ->orderBy('id DESC')
            ->limit(3)
            ->with('consulting')
            ->all();

        Debug::dd($lastFaq);

        return $this->render('last_faq', [
            'lastFaq' => $lastFaq,
        ]);
    }
}