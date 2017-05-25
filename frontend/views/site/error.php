<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
if ($exception->statusCode == 404){
    ?>
    <section class="dev">

        <div class="container">

            <h1 style="color:#ee2e24;" class="dev__title">404</h1>

            <p class="dev__subtitle">Страница не найдена</p>

            <form class="dev__form" action="">
                <input type="text" placeholder="Выслать на email">
                <button>подписаться</button>
            </form>

        </div>

    </section>
    <?php
}else{
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
<?php }; ?>