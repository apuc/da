<!--<form action="/secure/products/import/import" method="post" id="import_form" enctype="multipart/form-data">-->
<!--    <label for="import_file"><h4>Загрузите Excel-файл</h4></label>-->
<!--    <input type="file" name="import_file" id="import_file" accept="application/vnd.ms-excel, .xlsx" required>-->
<!--    <br>-->
<!--    <input type="submit" value="Начать импорт">-->
<!---->
<!--    <input type="hidden" name="_csrf" value="-->
<!--</form>-->


<?php

use backend\modules\products\forms\UploadForm;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'import_form',
    'action' => '/secure/products/import/import',
    'options' => [
        'enctype' => 'multipart/form-data',
    ]
]);
$model = new UploadForm();
?>

<?= $form->field($model, 'imageFile')->fileInput(['accept' => 'application/vnd.ms-excel, .xlsx']) ?>

<button>Submit</button>

<?php ActiveForm::end() ?>
