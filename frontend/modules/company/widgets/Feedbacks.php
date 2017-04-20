<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 20.04.2017
 * Time: 0:00
 */

namespace frontend\modules\company\widgets;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\CompanyFeedback;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class Feedbacks extends Widget
{

    public $categoryId;

    public function run()
    {
        $company = null;
        if(!empty($this->categoryId)){
            $company = Company::find()
                ->joinWith('categories')
                ->where(['cat_id' => $this->categoryId])
                ->all();
            $company = ArrayHelper::getColumn($company, 'id');
        }

        $feedbacks = CompanyFeedback::find()
            ->filterWhere(['company_id' => $company])
            ->orderBy('RAND()')
            ->limit(8)
            ->with(['user', 'company'])
            ->all();

        return $this->render('feedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

}