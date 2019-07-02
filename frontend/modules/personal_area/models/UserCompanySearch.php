<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.07.2017
 * Time: 15:53
 */

namespace frontend\modules\personal_area\models;

use common\classes\Debug;
use frontend\modules\company\models\Company;
use Yii;
use yii\data\ActiveDataProvider;

class UserCompanySearch extends Company
{
    public function search($params)
    {
        $query = Company::find();

        if(Yii::$app->controller->id == 'user-company' && Yii::$app->controller->action->id == 'index')
        {
            $query->select(['id', 'address', 'photo', 'email', 'name',
                'status','slug', 'dt_end_tariff']);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
                'pageSizeParam' => false,
            ],
        ]);

        $this->load($params);

        $query->andWhere([
            'user_id' => $params['user_id'],
            /*'status' => [1,0,2]*/
        ]);

        $query->andWhere(['!=', 'status', 3]);

        $query->orderBy('dt_update DESC');


        $query->with('tariff', 'allPhones');
        return $dataProvider;
    }
}