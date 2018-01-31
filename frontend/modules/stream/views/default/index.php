<?php
/**
 * @var $model \common\models\db\VkStream
 * @var $count
 * @var $meta_title
 * @var $meta_desc
 */
use common\classes\DateFunctions;
use common\models\User;

$this->title = $meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_desc,
] );
$this->registerJsFile('/theme/portal-donbassa/js/mansory.min.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>


<section class="parser">

    <div class="container">

        <h3 class="parser__title">Тем временем в соцсетях</h3>

        <div class="business__wrapper">

            <div class="business__content">

                <ul class="parser__top-nav">
                    <li><a href="<?= \yii\helpers\Url::to(['/stream'])?>">Все материалы <span><?= $count?></span></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream'])?>">ВК
                            <span><?= $count ?></span></a></li>
                </ul>

                <div class="parser__wrapper">
                <?php if (!empty($model1)): ?>
                    <div id="first-column" class="parser__column">
                        <?php foreach ($model1 as $item): ?>
                        <div class="parser__element <?= $item->id ?>">

                            <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--author">

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

                                <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_publish) ?></span>

                            </a>

                            <div class="social-wrap__item vk">
                                <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                            </div>

                            <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                            <!--    Windows</h3>-->

                            <?php if (!empty($item->text)): ?>

                                <p class="parser__element--descr"><?= $item->text ?></p>
                                <?php if (mb_strlen($item->text) > 131): ?>
                                    <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--more">читать далее</a>
                                <?php endif; ?>
                            <?php endif; ?>

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

                            <div class="parser__element--tools">

                                <a href="#" class="like likes <?= User::hasLike('stream', $item->id) ? 'active' : '' ?>"
                                   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                   data-id="<?= $item->id; ?>"
                                   data-type="stream">
                                    <i class="like-set-icon"></i>
                                    <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                </a>

                                <a href="#" class="views"><?= $item->views ?></a>
                                <?php if ($item->comment_status == 0):?>
                                    <?php $count = 0?>
                                <?php else:?>
                                    <?php $count = (isset($item->all_comments))? count($item->all_comments) : 0?>
                                <?php endif;?>
                                <a href="#" class="comments">
                                    <?= $count ?>
                                </a>

                            </div>
                            <?php if ($item->comment_status != 0): ?>

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

                                        <?php if(!empty($comment_item['photo'])): ?>
                                            <a data-fancybox="gallery" class="parser__element--photo"
                                               href="<?= $comment_item['photo'] ?>">
                                                <img src="<?= $comment_item['photo'] ?>" alt="">
                                            </a>
                                        <?php endif;?>

                                        <?php if(!empty($comment_item['sticker'])): ?>
                                            <a data-fancybox="gallery" class="parser__element--photo"
                                               href="<?= $comment_item['sticker'] ?>">
                                                <img src="<?= $comment_item['sticker'] ?>" style="width: 20%">
                                            </a>
                                        <?php endif;?>

                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php endif;?>

                        </div>
                    <?php endforeach; ?>
                    </div>

                    <?php else:?>
                        <h3>Записей пока нет</h3>
                    <?php endif;?>

                    <?php if (!empty($model2)): ?>
                    <div id="second-column" class="parser__column">
                        <?php foreach ($model2 as $item): ?>
                            <div class="parser__element <?= $item->id ?>">

                                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--author">

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

                                    <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_publish) ?></span>

                                </a>

                                <div class="social-wrap__item vk">
                                    <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                                </div>

                                <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                                <!--    Windows</h3>-->

                                <?php if (!empty($item->text)): ?>

                                    <p class="parser__element--descr"><?= $item->text ?></p>
                                    <?php if (mb_strlen($item->text) > 131): ?>
                                        <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--more">читать далее</a>
                                    <?php endif; ?>
                                <?php endif; ?>

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

                                <div class="parser__element--tools">

                                    <a href="#" class="like likes <?= User::hasLike('stream', $item->id) ? 'active' : '' ?>"
                                       csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                       data-id="<?= $item->id; ?>"
                                       data-type="stream">
                                        <i class="like-set-icon"></i>
                                        <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                    </a>

                                    <a href="#" class="views"><?= $item->views ?></a>

                                    <?php if ($item->comment_status == 0):?>
                                        <?php $count = 0?>
                                    <?php else:?>
                                        <?php $count = (isset($item->all_comments)) ? count($item->all_comments) : 0?>
                                    <?php endif;?>
                                    <a href="#" class="comments">
                                        <?= $count ?>
                                    </a>

                                </div>

                                <?php if ($item->comment_status != 0): ?>
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

                                                <?php if(!empty($comment_item['photo'])): ?>
                                                    <a data-fancybox="gallery" class="parser__element--photo"
                                                       href="<?= $comment_item['photo'] ?>">
                                                        <img src="<?= $comment_item['photo'] ?>" alt="">
                                                    </a>
                                                <?php endif;?>

                                                <?php if(!empty($comment_item['sticker'])): ?>
                                                    <a data-fancybox="gallery" class="parser__element--photo"
                                                       href="<?= $comment_item['sticker'] ?>">
                                                        <img src="<?= $comment_item['sticker'] ?>" style="width: 20%">
                                                    </a>
                                                <?php endif;?>

                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                <?php endif;?>

                            </div>
                        <?php endforeach; ?>
                    </div>


                    <?php else:?>
                    <h3>Записей пока нет</h3>
                    <?php endif;?>
              <!--  <span class="stream-flag"></span>-->
                </div>

                <div class="parser__more">

                    <a href="#"  class="show-more show-more-stream" data-dt="" data-step="1" csrf-token="<?= Yii::$app->request->getCsrfToken() ?>">загрузить еще</a>

                </div>

            </div>

            <?= \frontend\modules\stream\widgets\ShowTopStream::widget(); ?>
        </div>

    </div>

</section>