<?php
/**
 * @var $model \common\models\db\VkStream
 * @var $count integer
 * @var $countVk integer
 * @var $countTw integer
 */

use common\classes\DateFunctions;
use common\models\User;
use common\classes\Debug;

$this->title = (empty($model))? '' : $model->title.' | Портал DA Info Pro';
$this->registerMetaTag([
    'name' => 'description',
    'content' => (empty($model->descr)) ? 'На Портале DA Info Pro «' . $model->title . '». Популярное из социальной сети ВКонтакте в рубрике «В соцсетях»: юмор, мемы, мотивация, бизнес, лайфхаки, стиль.' : $model->meta_descr,
]);

$this->registerMetaTag([
    'property' => 'og:title',
    'content' => $model->title,
]);

$this->registerMetaTag([
    'property' => 'og:url',
    'content' => 'https://da-info.pro/stream/'.$model->slug,
]);

$this->registerMetaTag([
    'property' => 'og:site_name',
    'content' => 'Портал России и ДНР DA Info Pro: новости, компании, афиши, консультации.',
]);

$this->registerMetaTag([
    'property' => 'og:image',
    'content' => (!empty($model->photo)) ? $model->photo: '',
]);



$this->registerJsFile('/theme/portal-donbassa/js/mansory.min.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>

<section class="parser">

    <div class="container">

        <h3 class="parser__title"><?= (empty($model))? '' :$model->title?></h3>

        <div class="business__wrapper">

            <div class="business__content">

                <a class="parser__close" href="#">закрыть элемент</a>

                <ul class="parser__top-nav">
                    <li><a href="<?= \yii\helpers\Url::to(['/stream'])?>">Все материалы <span><?= $count ?></span></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream'])?>">ВК
                            <span><?= $countVk ?></span></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream'])?>">Tw
                            <span><?= $countTw ?></span></a></li>
                </ul>

                <div class="parser__single-wrapper">

                    <?php if(!empty($model)): ?>
                    <div class="parser__element single-parser-element">

                        <a href="#" class="parser__element--author">

                            <div class="avatar">

                                <?php if (!empty($model->author->photo)): ?>
                                    <img src="<?= $model->author->photo ?>" alt="">
                                <?php endif; ?>
                                <?php if (!empty($model->group->name)): ?>
                                        <img src="<?= $model->group->name ?>" alt="">
                                <?php endif; ?>
                            </div>

                            <div class="name">
                                <?php if (!empty($model->group->name)): ?>
                                    <?= $model->group->name ?>
                                <?php endif; ?>

                                <?php if (!empty($model->author->name)): ?>
                                    <?= $model->author->name ?>
                                <?php endif; ?>
                            </div>

                            <span class="date"><?= DateFunctions::getGetNiceDate($model->dt_publish) ?></span>

                        </a>

                        <div class="social-wrap__item vk">
                            <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                        </div>

                        <h3 class="parser__element--title"></h3>

                        <p class="parser__element--descr"><?= nl2br($model->text)?> </p>

                        <?php
                        if (!empty($model->photo)): ?>
                            <?php foreach ($model->allPhoto as $p):?>
                                <a data-fancybox="gallery" class="parser__element--photo"
                                   href="<?= $p ?>">
                                    <img src="<?= $p ?>" alt="">
                                </a>
                            <?php endforeach; ?>
                        <?php elseif (!empty($model->gif)): ?>
                           <?php foreach ($model->allGif as $gif):?>
                            <a data-fancybox="gallery" class="parser__element--photo"
                               href="<?= $gif?>">
                                <img src="<?= $gif?>" alt="">
                            </a>
                            <?php endforeach;?>
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
                            $countComment = count($model->comments);
                            endif;
                            ?>
                            <a href="#" class="comments count-comments"><?= $countComment?></a>

                            <a href="#" class="views"><?= $model->views ?></a>

                            <a class="parser__close" href="#">закрыть элемент</a>

                        </div>
                        <?php if ($model->comment_status != 0):?>
                            <div class="parser__element--comments-block">

                                <?php if (!empty($model->comments)): ?>
                                    <?php foreach ($model->comments as $comment_item): ?>

                                        <div class="avatar user-photo">
                                                <?= \common\classes\UserFunction::getUser_avatarStream($comment_item); ?>
                                        </div>

                                        <div class="name">
                                            <?= $comment_item->username ?>
                                        </div>
                                            <p><?= $comment_item->text ?></p>

                                        <?php if(!empty($comment_item->photo)): ?>
                                            <a data-fancybox="gallery" class="parser__element--photo"
                                               href="<?= $comment_item->photo ?>">
                                                <img src="<?= $comment_item->photo ?>" style="width: 50%">
                                            </a>
                                        <?php endif;?>

                                        <?php if(!empty($comment_item->sticker)): ?>
                                            <a data-fancybox="gallery" class="parser__element--photo"
                                               href="<?= $comment_item->sticker ?>">
                                                <img src="<?= $comment_item->sticker ?>" style="width: 20%">
                                            </a>
                                        <?php endif;?>

                                    <?php endforeach; ?>
                                <?php endif; ?>

                            </div>
                        <?php endif;?>
                        <?= \frontend\widgets\CommentsStream::widget([
                            'pageTitle' => 'Комментарии к ВК',
                            'postType' => 'vk_post',
                            'postId' => $model->id,
                        ]); ?>
                </div>
                    <?php else: ?>
                    <h3>Такого поста не существует</h3>
                    <?php endif; ?>

                <h3 class="parser__title">Продолжение ленты: </h3>

                <div class="parser__wrapper">

                    <?php if (!empty($interested1)): ?>

                    <div id="first-column" class="parser__column">
                        <?php foreach ($interested1 as $item): ?>
                            <div class="parser__element <?= $item->id ?>">

                                <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--author">

                                    <div class="avatar">
                                        <?php if (!empty($item->author->photo)): ?>
                                            <img src="<?= $item->author->photo ?>" alt="">
                                        <?php endif; ?>
                                        <?php if (!empty($item->group->photo)): ?>
                                            <img src="<?= $item->group->photo ?>" alt="">
                                        <?php endif; ?>
                                    </div>

                                    <div class="name">
                                        <?php if (!empty($item->group->name)): ?>
                                            <?= $item->group->name ?>
                                        <?php endif; ?>

                                        <?php if (!empty($item->author->name)): ?>
                                            <?= $item->author->name ?>
                                        <?php endif; ?>
                                    </div>

                                    <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_publish) ?></span>

                                </a>

                                <div class="social-wrap__item vk">
                                    <img src="/theme/portal-donbassa/img/soc/<?= $item->type ?>.png" alt="<?= $item->type ?>">
                                </div>

                                <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                                <!--    Windows</h3>-->

                                <?php if (!empty($item->text)): ?>

                                    <p class="parser__element--descr"><?= strip_tags($item->text) ?></p>
                                    <?php if (mb_strlen($item->text) > 131): ?>
                                        <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--more">читать далее</a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (!empty($item->photo)): ?>
                                    <a class="parser__element--photo"
                                       href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>">
                                        <img src="<?= $item->photo ?>" alt="">
                                    </a>
                                <?php elseif (!empty($item->gifPreview)): ?>
                                    <a class="parser__element--photo"
                                       href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>">
                                        <img src="<?= $item->gifPreview?>" alt="">
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
                                        <?php else:?>
                                            <?= (isset($item->comments)) ? count($item->comments) : 0?>
                                        <?php endif;?>
                                    </a>

                                </div>
                                <?php if ($item->comment_status != 0): ?>
                                    <div class="parser__element--comments-block">

                                        <?php if (!empty($item->comments)): ?>
                                            <?php foreach ($item->comments as $comment_item): ?>
                                                <div class="avatar">
                                                    <?php if(!empty($comment_item->avatar)): ?>
                                                        <img src="<?= $comment_item->avatar ?>" alt="">
                                                    <?php endif;?>
                                                </div>

                                                <div class="name">
                                                    <?= $comment_item->username ?>
                                                </div>

                                                <p><?= $comment_item->text ?></p>

                                                <?php if(!empty($comment_item->photo)): ?>
                                                    <a data-fancybox="gallery" class="parser__element--photo"
                                                       href="<?= $comment_item->photo ?>">
                                                        <img src="<?= $comment_item->photo ?>" alt="">
                                                    </a>
                                                <?php endif;?>

                                                <?php if(!empty($comment_item->sticker)): ?>
                                                    <a data-fancybox="gallery" class="parser__element--photo"
                                                       href="<?= $comment_item->sticker ?>">
                                                        <img src="<?= $comment_item->sticker ?>" style="width: 20%">
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
                        <?$error = 'Больше записей нет'?>
                    <?php endif;?>

                    <?php if (!empty($interested2)):?>

                    <div id="second-column" class="parser__column">
                        <?php foreach ($interested2 as $item): ?>
                        <div class="parser__element <?= $item->id ?>">

                            <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--author">

                                <div class="avatar">
                                    <?php if (!empty($item->author->photo)): ?>
                                        <img src="<?= $item->author->photo ?>" alt="">
                                    <?php endif; ?>
                                    <?php if (!empty($item->group->photo)): ?>
                                        <img src="<?= $item->group->photo ?>" alt="">
                                    <?php endif; ?>
                                </div>

                                <div class="name">
                                    <?php if (!empty($item->group->name)): ?>
                                        <?= $item->group->name ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item->author->name)): ?>
                                        <?= $item->author->name ?>
                                    <?php endif; ?>
                                </div>

                                <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_publish) ?></span>

                            </a>

                            <div class="social-wrap__item vk">
                                <img src="/theme/portal-donbassa/img/soc/<?= $item->type ?>.png" alt="<?= $item->type ?>">
                            </div>

                            <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                            <!--    Windows</h3>-->

                            <?php if (!empty($item->text)): ?>

                                <p class="parser__element--descr"><?= strip_tags($item->text) ?></p>
                                <?php if (mb_strlen($item->text) > 131): ?>
                                    <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug])?>" class="parser__element--more">читать далее</a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($item->photo)): ?>
                                <a class="parser__element--photo"
                                   href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>">
                                    <img src="<?= $item->photo ?>" alt="">
                                </a>

                            <?php elseif (!empty($item->gifPreview)): ?>
                                <a class="parser__element--photo"
                                   href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $item->slug]) ?>">
                                    <img src="<?= $item->gifPreview?>" alt="">
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
                                    <?php else:?>
                                        <?= (isset($item->comments)) ? count($item->comments) : 0?>
                                    <?php endif;?>
                                </a>

                            </div>
                            <?php if ($item->comment_status != 0): ?>
                                <div class="parser__element--comments-block">

                                    <?php if (!empty($item->comments)): ?>
                                        <?php foreach ($item->comments as $comment_item): ?>
                                            <div class="avatar">
                                                <?php if(!empty($comment_item->avatar)): ?>
                                                    <img src="<?= $comment_item->avatar ?>" alt="">
                                                <?php endif;?>
                                            </div>

                                            <div class="name">
                                                <?= $comment_item->username ?>
                                            </div>

                                            <p><?= $comment_item->text ?></p>

                                            <?php if(!empty($comment_item->photo)): ?>
                                                <a data-fancybox="gallery" class="parser__element--photo"
                                                   href="<?= $comment_item->photo ?>">
                                                    <img src="<?= $comment_item->photo ?>" alt="">
                                                </a>
                                            <?php endif;?>

                                            <?php if(!empty($comment_item->sticker)): ?>
                                                <a data-fancybox="gallery" class="parser__element--photo"
                                                   href="<?= $comment_item->sticker ?>">
                                                    <img src="<?= $comment_item->sticker ?>" style="width: 20%">
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

                        <?php $error = 'Больше записей нет'?>

                    <?php endif;?>

                    <?php if(empty($interested1) && empty($interested2)): ?>
                        <h3><?= $error?></h3>
                    <?php endif;?>
                        <!--<span class="stream-flag"></span>-->
                </div>

                    <div class="parser__more">

                        <a href="#"  class="show-more show-more-stream" data-last-post-dt="<?= $interested2[4]->dt_publish ?>" data-dt="" data-step="1" csrf-token="<?= Yii::$app->request->getCsrfToken() ?>">загрузить еще</a>

                    </div>


            </div>



        </div>
            <?= \frontend\modules\stream\widgets\ShowTopStream::widget(); ?>
        </div>

    </div>

</section>

