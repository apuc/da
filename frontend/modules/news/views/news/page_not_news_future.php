<?php
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<!-- start not-news.html-->
<section class="dev">

    <div class="container">

        <h1 class="dev__mistake">Даже мы не знаем</h1>

        <div class="dev__wrapper">

            <span class="dev__news-banner">какие новости будут завтра</span>

            <p class="dev__notice">Но вы можете узнать все самые свежие
                новости первыми</p>

            <div class="news__wrap_buttons">
                
                <span href="#" class=" show-more archive-news datepicker-here datepicker-wrap" >архив новостей </span>

            </div>

        </div>

        <div class="dev__elements">

            <div class="dev__news-photo">
                <?= \yii\helpers\Html::img('/theme/portal-donbassa/img/content/404-news.png')?>

            </div>


            <?= \frontend\widgets\NewsPageError::widget(); ?>

            <?= \frontend\widgets\StockErrorPage::widget(); ?>


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
<!-- end not-news.html-->