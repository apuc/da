<?php
$this->title = 'Мои объявления';

use yii\widgets\LinkPager;

$this->registerCssFile('/css/board.min.css');
?>
<div class="cabinet__inner-box">

    <h3>Мои объявления</h3>
    <a href="<?= \yii\helpers\Url::to(['/board/default/create'])?>" class="cabinet__inner-box--add">
        Добавить объявление
        <span>
            <img src="/theme/portal-donbassa/img/icons/add-pkg-icon.png" alt="">
        </span>
    </a>
    <?php if(!empty($ads)): ?>
        <?php foreach ($ads as $item): ?>

            <div class="cabinet__ads-box">
                <div class="cabinet__ads-box--img">
                    <?php if (!empty($item->cover)): ?>
                        <img src="<?= $item->cover ?>" alt="">
                    <?php else: ?>
                        <?php if(!empty($item->adsImgs)): ?>
                            <img src="<?= $item->adsImgs[0]->img_thumb; ?>" alt="">
                        <?php else: ?>
                            <img src="http://rub-on.ru/img/no-img.png" alt="">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="cabinet__ads-box--content">
                    <div class="cabinet__ads-box--data">
                        <span><?= \common\classes\DataTime::time($item->dt_update); ?></span>
                    </div>
                    <div class="cabinet__ads-box--text">
                        <span><a href="<?= \yii\helpers\Url::to(['/board/default/view', 'slug' => $item->slug, 'id' => $item->id]); ?>"><?= $item->title; ?></a></span>
                        <p><span class="cabinet__ads-box--price"><?= number_format($item->price, 0, '.', ' '); ?>
                             <i class="fa fa-rub" aria-hidden="true"></i></span></p>
                        <div class="bottom-content">

                            <?php
                            $listcat = \frontend\modules\board\models\BoardFunction::getCategoryById($item->category_id,[]);
                            $listcat = array_reverse($listcat);
                            $k = 1;
                            foreach ($listcat as $val): ?>
                                <a href="<?= \yii\helpers\Url::to(['category-ads', 'slug' => $val->slug]); ?>"
                                   class="average-ad-category"><?= $val->name; ?></a>
                                <?= ($k == count($listcat)) ? '' : '<span class="separatorListCategory">|</span>' ?>
                                <?php $k++; endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="cabinet__ads-box--edit">
                    <a href="<?= \yii\helpers\Url::to(['/board/default/update', 'id' => $item->id])?>" class="cabinet__like-block--company-edit">редактировать</a>
                    <!--<a href="#"><img src="/img/icons/edit-img.png"><span>редактировать</span></a>-->
                    <a href="<?= \yii\helpers\Url::to(['/board/default/delete', 'id' => $item->id])?>" class="cabinet__like-block--company-remove">удалить</a>
                </div>

                <?= $this->render('view-status', ['status' => $item->status, 'id' => $item->id]); ?>
            </div>


        <?php endforeach; ?>
        <div class="pagination">
            <?= LinkPager::widget(
                [
                    'pagination' => $pagination,
                    'options' => [
                        'class' => '',
                    ],
                    'prevPageCssClass' => 'pagination-prew',
                    'nextPageCssClass' => 'pagination-next',
                    'prevPageLabel' => '',
                    'nextPageLabel' => '',
                    'activePageCssClass' => 'active',

                ]) ?>
        </div>
    <?php else: ?>

    <div class="list-view">
        <div>
            <div class="cabinet__add-element">
                <p>Раздел пока пуст</p>
            <a href="<?= \yii\helpers\Url::to(['/board/default/create'])?>" class="show-more">добавить</a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
