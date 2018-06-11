<?php
/* @var $this yii\web\View */

/* @var $journals \common\models\db\Journal[] */

use common\classes\Debug;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use common\classes\WordFunctions;
$this->title = 'Журналы';
?>
<section class="news">
    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>


        <div class="news-slider-index-panel">
            <h3>Горячие темы</h3>
            <div class="buttons-wrap">
                <a href="#subscribe" class="subscribe-scroll">подписаться</a>
            </div>
        </div>
        <div class="news__wrap">

            <?php foreach ($journals as $journal): ?>
                <a href="<?= Url::to([
                    '/journal/journal/view',
                    'slug' => $journal->slug,
                ]); ?>" class=" news__wrap_item-sm-hot">
                    <div class="thumb">

                        <?php if (stristr($journal->photo, 'http')): ?>
                            <img class="thumbnail" src="<?= $journal->photo ?>" alt="">
                        <?php else: ?>
                            <img class="thumbnail"
                                 src="<?= $journal->photo; ?>" alt="">
                        <?php endif; ?>

                        <div class="content-row">
                            <span><small class="view-icon"></small><?=$journal->views?></span>
                            <span><small
                                        class="comments-icon"></small>0</span>
                        </div>
                    </div>
                    <div class="hover-wrap">
                        <h2><?= $journal->title; ?></h2>
                    </div>
                </a>

            <?php endforeach; ?>
        </div>

    </div>
</section>