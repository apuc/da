<?php
namespace frontend\widgets;
//use frontend\models\Lang;
use common\models\db\Lang;

class ShowLang extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('lang/view', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}
?>