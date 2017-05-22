<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/mainpage/mainpage/settings'], 'post', ['class' => 'form-horizontal']) ?>

<?= Html::label('Количество новостей в ленте:', 'day_feed_count'); ?>

<?= Html::textInput('day_feed_count', $dayFeedCount, ['class' => 'form-control', 'type' => 'number']); ?>

<br>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php echo Html::endForm() ?>

