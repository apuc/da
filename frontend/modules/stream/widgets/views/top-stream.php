<?php if(!empty($model)): ?>

<div class="promotions-sidebar" id="promotions-sidebar">
    <h3 class="main-title">топ 5 горячих постов</h3>
    <?php foreach ($model as $item): ?>
        <div class="parser__element">

            <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--author">

                <div>
                    <div class="avatar">
                        <?php if (!empty($item->author)): ?>
                            <img src="<?= $item->author->photo ?>" alt="">
                        <?php endif; ?>
                        <?php if (!empty($item->group)): ?>
                            <img src="<?= $item->group->getPhoto() ?>" alt="">
                        <?php endif; ?>
                    </div>

                    <div class="name">
                        <?php if (!empty($item->group)): ?>
                            <?= $item->group->name ?>
                        <?php endif; ?>

                        <?php if (!empty($item->author)): ?>
                            <?= $item->author->first_name . ' ' . $item->author->last_name ?>
                        <?php endif; ?>
                    </div>
                </div>
                <span class="date"><?= \common\classes\DataTime::timeStream($item->dt_publish); ?></span>

            </a>
            <?php if (!empty($item->photo)): ?>
                <a class="parser__element--photo"
                   href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>">
                    <img src="<?= $item->photo[0]->getLargePhoto() ?>" alt="">
                </a>

            <?php elseif (!empty($item->gif)): ?>
                <a class="parser__element--photo"
                   href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>">
                    <img src="<?= $item->gif[0]->getLargePreview()?>" alt="">
                </a>
            <?php endif; ?>
            <div class="social-wrap__item vk">
                <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
            </div>
            <div class="parser__element--tools">

                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>" class="like">
                    <i class="like-set-icon"></i>
                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                </a>

                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>" class="views"><?= $item->views ?></a>
                <?php if ($item->comment_status == 0):?>
                    <?php $count = 0?>
                <?php else:?>
                    <?php $count = (isset($item->all_comments)) ? count($item->all_comments) : 0?>
                <?php endif;?>
                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>" class="comments"><?= $count ?></a>

            </div>
        </div>
    <?php endforeach;?>
</div>

<?php endif;