<?php
use common\classes\DateFunctions;
use frontend\widgets\ShowRightRecommend;
use common\models\User;
use common\classes\Debug;

$this->title = $model->title.' | da-info';
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr,
]);

$this->registerJsFile('/theme/portal-donbassa/js/mansory.js', ['depends' => \yii\web\JqueryAsset::className()]);
$this->registerJsFile('/js/stream_new_post.js', ['depends' => \yii\web\JqueryAsset::className()]);


?>
<section class="parser">

    <div class="container">

        <h3 class="parser__title"><?= $model->title?></h3>

        <div class="business__wrapper">

            <div class="business__content">

                <!--<div class="parser__top-counter">

                    <a href="<?/*= \yii\helpers\Url::to(['/stream/default'])*/?>">Показать
                        <span class="counter counter-stream-new" data-count="<?/*= $count*/?>">0</span> новых записи</a>

                </div>

                <div class="parser__top-link">

                    <a href="#">Подписаться на эту тему</a>

                </div>-->

                <ul class="parser__top-nav">
                    <li><a href="#">Все материалы <span><?= $count?></span></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream'])?>">ВК
                            <span><?= $count?></span></a></li>
                </ul>

                <div class="parser__single-wrapper">

                    <? if(!empty($model)): ?>
                    <div class="parser__element">

                        <a href="#" class="parser__element--author">

                            <div class="avatar">

                                <?php if (!empty($model->author)): ?>
                                    <img src="<?= $model->author->photo ?>" alt="">
                                <?php endif; ?>
                                <?php if (!empty($model->group)): ?>

                                <?php endif; ?>
                            </div>

                            <div class="name">
                                <?php if (!empty($model->group)): ?>
                                    <?= $model->group->name ?>
                                <?php endif; ?>

                                <?php if (!empty($model->author)): ?>
                                    <?= $model->author->first_name . ' ' . $model->author->last_name ?>
                                <?php endif; ?>
                            </div>

                            <span class="date"><?= DateFunctions::getGetNiceDate($model->dt_add) ?></span>

                        </a>

                        <div class="social-wrap__item vk">
                            <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                        </div>

                        <h3 class="parser__element--title"></h3>

                        <p class="parser__element--descr"><?= $model->text?> </p>

                        <?php if (!empty($model->photo)): ?>
                            <a data-fancybox="gallery" class="parser__element--photo"
                               href="<?= $model->photo[0]->getLargePhoto() ?>">
                                <img src="<?= $model->photo[0]->getLargePhoto() ?>" alt="">
                            </a>

                        <?php elseif (!empty($model->gif)): ?>
                           <?foreach ($model->gif as $gif):?>
                            <a data-fancybox="gallery" class="parser__element--photo"
                               href="<?= $gif->gif_link?>">
                                <img src="<?= $gif->gif_link?>" alt="">
                            </a>
                            <?endforeach;?>
                        <?php endif; ?>

                        <div class="parser__element--tools">

                            <a href="#" class="like likes <?= User::hasLike('stream', $model->id) ? 'active' : '' ?>"
                               csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                               data-id="<?= $model->id; ?>"
                               data-type="stream">
                                <i class="like-set-icon"></i>
                                <span class="like-counter"><?= $model->getLikesCount() ?></span>
                            </a>
                            <?php
                            if ($model->comment_status == 0):
                            $countComment = 0;
                            else:
                            $countComment = count($model->all_comments);
                            endif;
                            ?>
                            <a href="#" class="comments count-comments"><?= $countComment?></a>

                            <a href="#" class="views"><?= $model->views?></a>

                        </div>
                        <?if ($model->comment_status != 0):?>
                            <div class="parser__element--comments-block">

                                <?php if (!empty($model->all_comments)): ?>
                                    <?php foreach ($model->all_comments as $comment_item): ?>
                                        <div class="avatar">
                                            <img src="<?= $comment_item['avatar'] ?>" alt="">
                                        </div>

                                        <div class="name">
                                            <?= $comment_item['username'] ?>
                                        </div>

                                        <p><?= $comment_item['text'] ?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        <?endif;?>
                        <?= \frontend\widgets\CommentsStream::widget([
                            'pageTitle' => 'Комментарии к ВК',
                            'postType' => 'vk_post',
                            'postId' => $model->id,
                        ]); ?>
                </div>
                    <? else: ?>
                    <h3>Такого поста не существует</h3>
                    <? endif; ?>

                <h3 class="parser__title">Смотрите далее: </h3>

                <div class="parser__wrapper">

                    <?if (!empty($interested1)): ?>

                    <div id="first-column" class="parser__column">
                        <?php foreach ($interested1 as $item): ?>
                            <div class="parser__element <?= $item->id ?>">

                                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--author">

                                    <div class="avatar">
                                        <?php if (!empty($item->author)): ?>
                                            <img src="<?= $item->author->photo ?>" alt="">
                                        <?php endif; ?>
                                        <?php if (!empty($item->group)): ?>

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

                                    <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_add) ?></span>

                                </a>

                                <div class="social-wrap__item vk">
                                    <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                                </div>

                                <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                                <!--    Windows</h3>-->

                                <?php if (!empty($item->text)): ?>

                                    <p class="parser__element--descr"><?= $item->text ?></p>
                                    <?php if (mb_strlen($item->text) > 131): ?>
                                        <a href="#" class="parser__element--more">читать далее</a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($item->photo)): ?>
                                    <a data-fancybox="gallery" class="parser__element--photo"
                                       href="<?= $item->photo[0]->getLargePhoto() ?>">
                                        <img src="<?= $item->photo[0]->getLargePhoto() ?>" alt="">
                                    </a>
                                <?php elseif (!empty($item->gif)): ?>
                                    <a data-fancybox="gallery" class="parser__element--photo"
                                       href="<?= $item->gif[0]->getLargePreview()?>">
                                        <img src="<?= $item->gif[0]->getLargePreview()?>" alt="">
                                    </a>
                                <?php endif; ?>

                                <div class="parser__element--tools">

                                    <a href="#" class="like likes <?= User::hasLike('stream', $item->id) ? 'active' : '' ?>"
                                       csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                       data-id="<?= $item->id; ?>"
                                       data-type="stream">
                                        <i class="like-set-icon"></i>
                                        <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                    </a>

                                    <a href="#" class="views"><?= $item->views ?></a>

                                    <a href="#" class="comments">
                                        <?php
                                        if ($item->comment_status == 0):?>
                                           <?= 0?>
                                        <?else:?>
                                            <?= (isset($item->all_comments)) ? count($item->all_comments) : 0?>
                                        <?endif;?>
                                    </a>

                                </div>
                                <? if ($item->comment_status != 0): ?>
                                    <div class="parser__element--comments-block">

                                        <?php if (!empty($item->all_comments)): ?>
                                            <?php foreach ($item->all_comments as $comment_item): ?>
                                                <div class="avatar">
                                                    <img src="<?= $comment_item['avatar'] ?>" alt="">
                                                </div>

                                                <div class="name">
                                                    <?= $comment_item['username'] ?>
                                                </div>

                                                <p><?= $comment_item['text'] ?></p>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                <?endif;?>

                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?else:?>
                        <?$error = 'Больше записей нет'?>
                    <?endif;?>

                    <?if (!empty($interested2)):?>

                    <div id="second-column" class="parser__column">
                        <?php foreach ($interested2 as $item): ?>
                        <div class="parser__element <?= $item->id ?>">

                            <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--author">

                                <div class="avatar">
                                    <?php if (!empty($item->author)): ?>
                                        <img src="<?= $item->author->photo ?>" alt="">
                                    <?php endif; ?>
                                    <?php if (!empty($item->group)): ?>

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

                                <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_add) ?></span>

                            </a>

                            <div class="social-wrap__item vk">
                                <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                            </div>

                            <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                            <!--    Windows</h3>-->

                            <?php if (!empty($item->text)): ?>

                                <p class="parser__element--descr"><?= $item->text ?></p>
                                <?php if (mb_strlen($item->text) > 131): ?>
                                    <a href="#" class="parser__element--more">читать далее</a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($item->photo)): ?>
                                <a data-fancybox="gallery" class="parser__element--photo"
                                   href="<?= $item->photo[0]->getLargePhoto() ?>">
                                    <img src="<?= $item->photo[0]->getLargePhoto() ?>" alt="">
                                </a>

                            <?php elseif (!empty($item->gif)): ?>
                                <a data-fancybox="gallery" class="parser__element--photo"
                                   href="<?= $item->gif[0]->getLargePreview()?>">
                                    <img src="<?= $item->gif[0]->getLargePreview()?>" alt="">
                                </a>
                            <?php endif; ?>

                            <div class="parser__element--tools">

                                <a href="#" class="like likes <?= User::hasLike('stream', $item->id) ? 'active' : '' ?>"
                                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                   data-id="<?= $item->id; ?>"
                                   data-type="stream">
                                    <i class="like-set-icon"></i>
                                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                </a>

                                <a href="#" class="views"><?= $item->views ?></a>

                                <a href="#" class="comments">
                                    <?php
                                    if ($item->comment_status == 0):?>
                                        <?= 0?>
                                    <?else:?>
                                        <?= (isset($item->all_comments)) ? count($item->all_comments) : 0?>
                                    <?endif;?>
                                </a>

                            </div>
                            <?if ($item->comment_status) :?>
                                <div class="parser__element--comments-block">

                                    <?php if (!empty($item->all_comments)): ?>
                                        <?php foreach ($item->all_comments as $comment_item): ?>
                                            <div class="avatar">
                                                <img src="<?= $comment_item['avatar'] ?>" alt="">
                                            </div>

                                            <div class="name">
                                                <?= $comment_item['username'] ?>
                                            </div>

                                            <p><?= $comment_item['text'] ?></p>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                            <?endif;?>

                        </div>
                    <?php endforeach; ?>
                    </div>

                    <?else:?>

                        <?$error = 'Больше записей нет'?>

                    <?endif;?>

                    <?if(empty($interested1) && empty($interested2)): ?>
                        <h3><?= $error?></h3>
                    <?endif;?>
                        <!--<span class="stream-flag"></span>-->
                </div>

                <div class="parser__more">

                    <a href="#"  class="show-more show-more-stream" data-step="1" csrf-token="<?= Yii::$app->request->getCsrfToken() ?>">загрузить еще</a>

                </div>


            </div>



        </div>
            <?= ShowRightRecommend::widget() ?>

        </div>

    </div>

</section>

