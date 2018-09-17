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

class Consultation extends Widget
{

    public function run()
    {
        $faq = CategoryFaq::find()
            ->joinWith('faq')
            //->where(['`faq`.`main_page`' => 1])
            //->with('faq')
            ->all();
//Debug::prn($faq);
/*        Debug::prn($faq->createCommand()->rawSql);
die();*/

        return $this->render('consultation', [
            /*'faq' => Faq::find()
                ->where(['main_page' => 1])
                ->with('company')
                ->with('category')
                ->with('consulting')
                ->all(),*/
            'faq' => $faq,
        ]);
    }

}