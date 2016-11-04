<?php
use yii\helpers\Url;
?>

<?php if (\Yii::$app->user->isGuest): ?>
    <div class="sign">
        <a href="<?= Url::to(['/user/security/login']) ?>"><img src="/frontend/web/theme/portal-donbassa/img/signin.png" alt=""><span>вход</span></a>
        <!--<a href="<?/*= Url::to(['/user/registration/register']) */?>"><img src="/frontend/web/theme/portal-donbassa/img/signup.png" alt=""><span>регистрация</span></a>-->
    </div>
<?php else: ?>
    <div class="sign">
        <a href="<?= Url::to(['/user/settings/profile']) ?>"><img src="/frontend/web/theme/portal-donbassa/img/signin.png" alt=""><span><?= \Yii::$app->user->identity->username; ?></span></a>
        <a href="<?= Url::to(['/user/security/logout']) ?>" data-method="post"><img src="/frontend/web/theme/portal-donbassa/img/signup.png" alt=""><span>Выход</span></a>
    </div>
<?php endif; ?>