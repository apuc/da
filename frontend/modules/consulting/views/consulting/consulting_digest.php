<?php use yii\helpers\Url;

$this->title = $meta_title;

$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );

?>
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
            <?php if($consulting->about_company): ?>
                <li>
                    <a href="<?= Url::to( [ "/consulting/consulting/view", 'slug' => $consulting->slug ] ); ?>"><span
                            class="marker"></span>О компании</a>
                </li>
            <?php endif; ?>
            <?php if($consulting->documents): ?>
                <li>
                    <a class="active" href="<?= Url::to( [ '/documents/' . $consulting->slug ] ) ?>"><span class="marker"></span><?= $consulting->title_digest;?></a>
                    <?= \frontend\modules\consulting\widgets\GenerateCatTree::widget( [
                        'categories' => $categories_posts,
                        'id_attr'        => 'posts-id',
                        'active_id'      => $active_id,
                        'url'            => $url,
                    ] ); ?>
                </li>
            <?php endif; ?>
            <?php if($consulting->posts): ?>
                <li>
                    <a href="<?= Url::to( [ '/posts/' . $consulting->slug ] ) ?>"><span class="marker "></span>Статьи</a>
                </li>
            <?php endif; ?>
            <?php if($consulting->faq): ?>
                <li>
                    <a faq-id="0" href="<?= Url::to( [ '/faq/' . $consulting->slug ] ) ?>"><span class="marker"></span>Вопрос / ответ</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="consult-item-content">
        <div class="faq">
            <form class="consult-search-form" action="#">
                <input class="consult-search" type="text" placeholder="найти в разделе">
                <input type="submit" value="искать">
            </form>
            <div class="clearfix"></div>
            <h3 class="faq-section"><?= $cat_posts; ?></h3>
            <div class="faq-items">
<!--                --><?php //\yii\widgets\Pjax::begin(); ?>
                <?= \yii\widgets\ListView::widget( [
                    'dataProvider' => $dataProvider,
                    'itemView'     => '_posts_digest_list',
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
