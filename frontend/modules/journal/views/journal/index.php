<?php
/* @var $this yii\web\View */

/* @var $journals \common\models\db\Journal[] */

use common\classes\Debug;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use common\classes\WordFunctions;
$this->title = 'Журналы';
$this->params['breadcrumbs'][] = 'Журналы';
$this->registerCssFile('css/raw/site.css');
?>
<section class="news">
    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>


        <div class="news__wrap">

            <?php foreach ($journals as $journal): ?>
                <div class="journal__item">
                    <a href="<?= Url::to([
                                     '/journal/journal/view',
                                      'slug' => $journal->slug,
                                   ]); ?>"
                       class="journal__thumb">

                        <img src="<?= $journal->photo // "img/DA_01-1.jpg"?>" alt="">

                        <div class="hover-wrap"></div>
                    </a>
                    <div class="journal__content">
                        <a class="journal__title" href="#"><?= $journal->title; ?></a>
                        <span class="views"><?=$journal->views?></span>
                    </div>
                </div>



            <?php endforeach; ?>
        </div>

    </div>
</section>