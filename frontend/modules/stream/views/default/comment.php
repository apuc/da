<div class="avatar">
    <img src="<?= $avatar?>" alt="">
</div>

<div class="name">
    <?/*= $comment->author['first_name'] . ' ' . $comment->author['last_name'] */?>
    <?= Yii::$app->user->identity->username?>
</div>

<p><?= $message ?></p>