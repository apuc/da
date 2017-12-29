<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.03.2017
 * Time: 16:28
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\Company;
use Yii;
use yii\base\Widget;

class CompanyMain extends Widget
{
    public $useReg;
    public function run()
    {
        $query = Company::find()
            ->where(['status' => 0, 'main' => 1]);
            //->orderBy('views DESC')
        if($this->useReg != -1){
            $query->andWhere(
                [
                    'region_id' => $this->useReg,
                ]
            );
        }
        $companies = $query->orderBy('RAND()')
            ->limit(12)
            ->all();
        return $this->render('company_main', ['companies'=>$companies]);
    }

}