<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 11.10.2016
 * Time: 15:22
 */

namespace frontend\modules\mainpage\widgets;


use common\classes\Debug;
use yii\base\Widget;
use yii\data\SqlDataProvider;

class Poster extends Widget
{

    public function run()
    {
        $query = \common\models\db\Poster::find()->andWhere(['>',"dt_event",time()])->orderBy('dt_event');
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        $one_poster = \common\models\db\Poster::find()->andWhere(['>',"dt_event",time()])->limit(1)->orderBy('dt_event')->all();

        return $this->render('poster', [
            'dataProvider' => $dataProvider,
            'one_poster' => $one_poster
        ]);
    }

}