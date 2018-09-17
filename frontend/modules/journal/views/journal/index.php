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
                <a href="<?= Url::to([
                    '/journal/journal/view',
                    'slug' => $journal->slug,
                ]); ?>" class="journal_item">
                    <div class="thumb">

                        <?php if (stristr($journal->photo, 'http')): ?>
                            <img class="thumbnail" src="<?= $journal->photo ?>" alt="">
                        <?php else: ?>
                            <img class="thumbnail"
                                 src="<?= $journal->photo; ?>" alt="">
                        <?php endif; ?>

                        <div class="content-row">
                            <span><small class="view-icon"></small><?=$journal->views?></span>
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