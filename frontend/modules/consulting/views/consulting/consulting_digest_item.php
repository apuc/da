<?php use yii\helpers\Url;

$this->title = $posts->title ;
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
                <a href="<?= Url::to( [ '/documents/' . $consulting->slug ] ) ?>" class="parent active"><span class="marker"></span><?= $consulting->title_digest;?></a>
                <?= \frontend\modules\consulting\widgets\GenerateCatTree::widget( [
                    'categories' => $categories_posts,
                    'id_attr'    => 'post-id',
                    'active_id'  => $active_id,
                    'url'        => $url,
                ] ); ?>
            </li>
            <li>
                <a href="<?= Url::to( [ '/posts/' . $consulting->slug ] ) ?>"><span class="marker"></span>Статьи</a>

            </li>
            <li>
                <a class="parent" faq-id="0" href="<?= Url::to( [ '/faq/' . $consulting->slug ] ) ?>"><span
                        class="marker"></span>Вопрос / ответ</a>

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
            <h3 class="faq-section"><?= $cat_posts; ?></h3>
            <div class="faq-items">
                <div class="faq-item">
                    <span class="date"><?= date( 'd.m.y', $posts->dt_add ); ?></span>
                    <p class="quastion">
                        <?= $posts->title; ?>
                    </p>
                    <?php if($posts->photo): ; ?>
                        <div class="faq-item-img">
                            <img src="<?= $posts->photo; ?>" alt="">
                        </div>
                    <?php endif; ?>
                    <p class="answer">
                        <?= $posts->content; ?>
                    </p>
                    <a href="<?= Url::to( [ '/consulting/consulting/documents', 'slugcategory' => $category->slug ] ); ?>"
                       class="read-answer">Вернуться
                        в
                        раздел</a>
                </div>
            </div>
        </div>
    </div>

</div>
