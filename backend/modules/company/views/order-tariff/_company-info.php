<?php
$company = \common\models\db\Company::find()->where(['id' => $id])->one();
?>

<?= \yii\helpers\Html::a(
        $company->name,
        \yii\helpers\Url::to(['/company/company/view', 'id' => $company->id]),
        ['target' => '_blank']
); ?>
<p><strong>Email:</strong></p>
<p><?= $company->email; ?></p>

<?php if(!empty($company->phone)): ?>
    <div class="single-afisha__place--phones">
        <span class="single-afisha__place--phone"><strong>Телефоны</strong></span>
        <?php
            $phone = explode(' ', $company->phone);
        ?>
        <ul class="business__sm-item--numbers">
            <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
            <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
        </ul>
    </div>
<?php endif; ?>