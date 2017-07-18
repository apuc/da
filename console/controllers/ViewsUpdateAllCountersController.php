<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 13.07.2017
 * Time: 16:53
 */

namespace console\controllers;
use common\classes\Debug;
use common\models\db\Company;
use common\models\db\News;
use yii\console\Controller;
use yii\helpers\ArrayHelper;

class ViewsUpdateAllCountersController extends Controller
{
    public function actionIndex()
    {
        $this->countNews();
        $this->countCompany();
    }

    protected function countNews()
    {
        $news = News::find()
            ->where(['status' => 0])
            ->andWhere(['>=', 'dt_public', time() - 2592000*3])
            ->all();

        foreach ($news as $item){
            $randNumber = rand(1,10);
            News::updateAllCounters(['views' => $randNumber], ['id' => $item->id]);
            echo 'ID новсти - ' . $item->id .  ' Увеличено на ' . $randNumber . "\n";
        }
    }

    protected function countCompany()
    {
        $company = Company::find()->where(['status' => 0])->all();
        foreach ($company as $item){
            $randNumber = rand(1,10);
            Company::updateAllCounters(['views' => $randNumber], ['id' => $item->id]);
            echo 'ID компании - ' . $item->id .  ' Увеличено на ' . $randNumber . "\n";
        }
    }

}