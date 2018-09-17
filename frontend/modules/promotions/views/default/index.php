<?php
$this->title = "Мои компании";
?>

<div class="cabinet__inner-box">

    <h3>Мои компании</h3>

    <a href="<?= \yii\helpers\Url::to(['/promotions/promotions/create']); ?>" class="cabinet__inner-box--add">
        добавить
        <span>
            <img src="/theme/portal-donbassa/img/icons/add-pkg-icon.png" alt="">
        </span>
    </a>
<pre>
  <?php \common\classes\Debug::prn($promotions->title)?>
</div>