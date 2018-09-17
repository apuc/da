<?php
/**
 * @var $key_val array
 */
use common\models\db\Question;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<?php echo Html::beginForm(['/active_poll/default'],'post',['class' => 'form-horizontal']) ?>
<?php echo Html::label('Активный опрос','active_poll', ['class'=>'control-label']) ?>
<?php echo Html::dropDownList('active_poll', $key_val['active_poll'],ArrayHelper::map( Question::find()->orderBy('dt_add DESC')->all(),'id','title'),['class'=>'form-control']) ?>

<br>
<?php echo Html::submitButton('Сохранить', ['class'=>'btn btn-success']) ?>
<?php echo Html::endForm() ?>
