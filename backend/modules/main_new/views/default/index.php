<?php
/**
 * @var $key_val array
 */
use common\models\db\News;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>
<?php echo Html::beginForm(['/main_new/default'],'post',['class' => 'form-horizontal']) ?>
<?php echo Html::label('Главная новость','main_new', ['class'=>'control-label']) ?>
<?php echo Html::dropDownList('main_new', $key_val['main_new'],ArrayHelper::map( News::find()->orderBy('dt_add DESC')->all(),'id','title'),['class'=>'form-control']) ?>

<br>
<?php echo Html::submitButton('Сохранить', ['class'=>'btn btn-success']) ?>
<?php echo Html::endForm() ?>
