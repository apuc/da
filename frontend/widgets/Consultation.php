<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\CategoryFaq;
use common\models\db\Faq;
use common\models\db\Lang;
use yii\base\Widget;
use yii\db\ActiveQuery;

class Consultation extends Widget
{

    public function run()
    {
        $faq = CategoryFaq::find()
            ->joinWith([
                'faq' => function (ActiveQuery $query) {
                    $query->limit(6);
                }
            ])
            ->all();

        return $this->render('consultation', [
            'faq' => $faq,
        ]);
    }

}