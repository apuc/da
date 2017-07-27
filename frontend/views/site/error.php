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
            <h1 class="dev__mistake">Ошибка</h1>
            <div class="dev__wrapper">
                <span class="dev__banner">404</span>
                <p class="dev__notice">Такой страницы не существует,
                    но вы можете вернуься на <a href="/">главную</a>
                    или оставьте заявку ─ мы перезвоним Вам
                    и ответим на все вопросы</p>
                <a href="#" id="send-error-message" class="show-more">сообщить о битой ссылке</a>
            </div>

            <div class="dev__photo">
                <img src="/theme/portal-donbassa/img/content/404-banner.png" alt="">
            </div>

            <div class="dev__elements">

                <?= \frontend\widgets\NewsPageError::widget(); ?>

                <h3 class="main-title">следите за акциями</h3>

                <div class="dev__elements--news">

                    <a href="#" class="stock__item">
                        <div class="stock__item_visible">
                            <div class="thumb">
                                <img src="img/home-content/stock-pic-1.png" alt="">
                                <span class="time-icon"></span>
                            </div>
                            <div class="stock__item_label">
                                <p>Грандиозное снижение цен на шкафы - 20%</p>
                            </div>
                            <div class="content">
                                <p> Акция проходит <small>с 01.01.2017</small> </p>
                                <!-- <a href="">подробнее</a>-->
                            </div>

                        </div>
                    </a>

                    <a href="#" class="stock__item">
                        <div class="stock__item_visible">
                            <div class="thumb">
                                <img src="img/home-content/stock-pic-1.png" alt="">
                                <span class="time-icon"></span>
                            </div>
                            <div class="stock__item_label">
                                <p>Грандиозное снижение цен на шкафы - 20%</p>
                            </div>
                            <div class="content">
                                <p> Акция проходит <small>с 01.01.2017</small> </p>
                                <!-- <a href="">подробнее</a>-->
                            </div>

                        </div>
                    </a>

                    <a href="#" class="stock__item">
                        <div class="stock__item_visible">
                            <div class="thumb">
                                <img src="img/home-content/stock-pic-1.png" alt="">
                                <span class="time-icon"></span>
                            </div>
                            <div class="stock__item_label">
                                <p>Грандиозное снижение цен на шкафы - 20%</p>
                            </div>
                            <div class="content">
                                <p> Акция проходит <small>с 01.01.2017</small> </p>
                                <!-- <a href="">подробнее</a>-->
                            </div>

                        </div>
                    </a>

                    <a href="#" class="stock__item">
                        <div class="stock__item_visible">
                            <div class="thumb">
                                <img src="img/home-content/stock-pic-1.png" alt="">
                                <span class="time-icon"></span>
                            </div>
                            <div class="stock__item_label">
                                <p>Грандиозное снижение цен на шкафы - 20%</p>
                            </div>
                            <div class="content">
                                <p> Акция проходит <small>с 01.01.2017</small> </p>
                                <!-- <a href="">подробнее</a>-->
                            </div>

                        </div>
                    </a>

                </div>

            </div>
            <!-- <p class="dev__subtitle"><a href="#">оставьте заявку</a>, чтобы <a href="#">первым узнать</a> о всех
                 нововведениях портала</p>

             <form class="dev__form" action="">
                 <input type="text" placeholder="Выслать на email">
                 <button>подписаться</button>
             </form>
     -->
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