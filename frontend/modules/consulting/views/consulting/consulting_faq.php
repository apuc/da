<?php use yii\helpers\Url;

$this->title = $consulting->title ;
; ?>
<div class="consult-item">
    <div class="consult-item-mnu">
        <p class="consult-img">
            <i class="fa <?= $consulting->icon; ?>"></i>
        </p>
        <h4><?= $consulting->title; ?></h4>
        <div class="shape">
            <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
        </div>
        <ul class="consult-item-mnu-menu end">
            <li>
                <a href="<?= Url::to( [ "/consulting/consulting/view", 'slug' => $consulting->slug ] ); ?>"><span
                        class="marker"></span>О компании</a>
            </li>
            <li>
                <a href="<?= Url::to( [ '/documents/' . $consulting->slug ] ) ?>"><span class="marker"></span><?= $consulting->title_digest;?></a>
            </li>
            <li>
                <a href="<?= Url::to( [ '/posts/' . $consulting->slug ] ) ?>"><span class="marker"></span>Статьи</a>
            </li>
            <li>
                <a class="active parent" faq-id="0" href="<?= Url::to( [ '/faq/' . $consulting->slug ] ) ?>"><span class="marker"></span>Вопрос / ответ</a>
                <?= \frontend\modules\consulting\widgets\GenerateCatTree::widget( [
                    'categories' => $categories_faq,
                    'id_attr'        => 'faq-id',
                    'active_id'      => $active_id,
                    'url'            => $url,
                ] ); ?>

            </li>
        </ul>
    </div>
    <div class="consult-item-content">
        <div class="faq">
            <form class="consult-search-form" action="#">
                <input class="consult-search" type="text" placeholder="найти в разделе">
                <input type="submit" value="искать">
            </form>
            <div class="clearfix"></div>
            <h3 class="faq-section"><?= $cat_faq; ?></h3>
            <div class="faq-items">
<!--                --><?php //\yii\widgets\Pjax::begin(); ?>

                <?= \yii\widgets\ListView::widget( [
                    'dataProvider' => $dataProvider,
                    'itemView'     => '_faq_list',
                    'layout'       => "{items}\n<div class='paginator'>{pager}</div>",
                    'pager'        => [
                        'options'          => [
                            'class' => 'paginator',
                            'tag'   => 'div',
                        ],
                        'maxButtonCount'   => 5,//($md->isMobile() or $md->isTablet()) ? 5 : 15,
                        'nextPageCssClass' => 'next',
                        'nextPageLabel'    => '<img src="/theme/portal-donbassa/img/paginator-right.png" alt="">',
                        'prevPageCssClass' => 'prev',
                        'prevPageLabel'    => '<img src="/theme/portal-donbassa/img/paginator-left.png" alt="">',
                    ]
                ] ) ?>


<!--                --><?php //\yii\widgets\Pjax::end(); ?>
            </div>
        </div>
    </div>

</div>
