<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 06.05.2017
 * Time: 11:27
 */

namespace frontend\modules\pages\widgets;

use common\classes\Debug;
use common\models\db\Pages;
use common\models\db\PagesGroup;
use yii\base\Widget;

class PagesFromGroup extends Widget
{

    public $model;

    public function run()
    {
        $pages = Pages::find()
            ->where(['group_id' => $this->model->group_id])
            ->andWhere(['!=', 'id', $this->model->id])
            ->all();
        if(!$pages){
            $pages = Pages::find()
                ->where(['!=', 'id', $this->model->id])
                ->orderBy('RAND()')
                ->limit(5)
                ->all();
        }
        return $this->render('pages_from_group',[
            'pages' => $pages
        ]);
    }

}