<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 01.04.2017
 * Time: 12:22
 */

namespace frontend\modules\consulting\widgets;

use common\models\db\Consulting;
use yii\base\Widget;

class ConsultingCompanies extends Widget
{
    public function run()
    {
        $consulting = Consulting::find()
            ->orderBy('id DESC')
            ->where(['sidebar' => 1])
            ->all();

        return $this->render('consulting_companies', [
            'consulting' => $consulting,
        ]);
    }
}