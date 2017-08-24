<div class="avatar">
    <img src="<?= $avatar?>" alt="">
</div>

<div class="name">
    <?= Yii::$app->user->identity->username?>
</div>

<p><?= $message ?></p>