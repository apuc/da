<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\modules\poster\widgets;

use common\classes\Debug;
use common\models\db\KeyValue;
use common\models\db\Poster;
use yii\base\Widget;

class Popular extends Widget
{

    public function run()
    {
        $popularPosters = Poster::find()
            ->where(['popular' => 1])
            ->andWhere(['>=', 'dt_event', time()])
            ->orderBy('RAND()')
            ->limit(5)
            ->with('categories')
            ->all();

        return $this->render('popular', [
            'popularPosters' => $popularPosters,
        ]);
    }

}