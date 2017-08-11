<h1>Введите сообщение:</h1>
<?$form = \yii\widgets\ActiveForm::begin()?>
    <?= $form->field($model, 'username')->textInput()->label('Имя получателя')?>
    <?= $form->field($model, 'email')->textInput()->label('Email получателя')?>
    <?= $form->field($model, 'content')->textInput()->label('Вопрос')?>
    <label class="control-label">Тема сообщения:</label>
    <?= \yii\helpers\Html::textInput('subject', '', ['class' => 'form-control'])?>
    <label class="control-label">Текст сообщения:</label>
    <?= \yii\helpers\Html::textarea('text-mail', '', ['class' => 'form-control'])?>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
    </div>
<? \yii\widgets\ActiveForm::end() ?>
