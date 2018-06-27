<?php
/**
 * @var $model \common\models\db\VkStream
 * @var $count integer
 * @var $countVk integer
 * @var $countTw integer
 * @var $countGplus integer
 * @var $meta_title
 * @var $meta_desc
 */
use common\classes\DateFunctions;
use common\models\User;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_desc,
]);
$this->registerJsFile('/theme/portal-donbassa/js/mansory.min.js', ['depends' => \yii\web\JqueryAsset::className()]);
?>
<style>
    .social-wrap__item img{
        width: 100%;
        height: 100%;
        max-width: none;
        margin-top: 0;
    }
</style>

<section class="parser">

    <div class="container">

        <h3 class="parser__title">Тем временем в соцсетях</h3>

        <div class="business__wrapper">

            <div class="business__content">

                <ul class="parser__top-nav">
                    <li><a href="<?= \yii\helpers\Url::to(['/stream']) ?>">Все материалы <span><?= $count ?></span></a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream', 'social' => 'vk']) ?>">ВК
                            <span><?= $countVk ?></span></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream', 'social' => 'tw']) ?>">Tw
                            <span><?= $countTw ?></span></a></li>
                    <li><a href="<?= \yii\helpers\Url::to(['/stream', 'social' => 'gplus']) ?>">G+
                            <span><?= $countGplus ?></span></a></li>
                </ul>

                <div class="parser__wrapper">
                    <?php if (!empty($model1)): ?>
                        <div id="first-column" class="parser__column">
                            <?php foreach ($model1 as $item): ?>
                                <?php $itemUrl = [
                                    '/stream/default/view',
                                    'slug' => $item->slug,
                                    'social' => Yii::$app->request->get('social'),
                                ]+($item->type !== 'vk' ? ['type' => $item->type]:[]); ?>
                                <div class="parser__element <?= $item->id ?>">

                                    <a href="<?= \yii\helpers\Url::to($itemUrl) ?>" class="parser__element--author">

                                        <div class="avatar">
                                            <?php if (!empty($item->author->photo)): ?>
                                                <img src="<?= $item->author->photo ?>" alt="">
                                            <?php endif; ?>
                                            <?php if (!empty($item->group)): ?>
                                                <img src="<?= $item->group->photo ?>" alt="">
                                            <?php endif; ?>
                                        </div>

                                        <div class="name">
                                            <?php if (!empty($item->group)): ?>
                                                <?= $item->group->name ?>
                                            <?php endif; ?>

                                            <?php if (!empty($item->author->name)): ?>
                                                <?= $item->author->name ?>
                                            <?php endif; ?>
                                        </div>

                                        <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_publish) ?></span>

                                    </a>

                                    <div class="social-wrap__item">
                                        <img src="/theme/portal-donbassa/img/soc/<?= $item->type ?>.png"
                                             alt="<?= $item->type ?>">
                                    </div>

                                    <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                                    <!--    Windows</h3>-->

                                    <?php if (!empty($item->text)): ?>

                                        <p class="parser__element--descr" style = "display: block; height: 100%;"><?= $item->text ?></p>
                                        <?php if (mb_strlen($item->text) > 131): ?>
                                            <a href="<?= \yii\helpers\Url::to($itemUrl) ?>" class="parser__element--more">читать далее</a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item->photo)): ?>
                                        <a class="parser__element--photo"
                                           href="<?= \yii\helpers\Url::to($itemUrl) ?>">
                                            <img src="<?= $item->photo ?>" alt="">
                                        </a>

                                    <?php elseif (!empty($item->gifPreview)): ?>
                                        <a class="parser__element--photo"
                                           href="<?= \yii\helpers\Url::to($itemUrl) ?>">
                                            <img src="<?= $item->gifPreview ?>" alt="">
                                        </a>
                                    <?php endif; ?>

                                    <div class="parser__element--tools">

                                        <a href="#"
                                           class="like likes <?= User::hasLike($item->type === 'vk' ? 'stream' : $item->type, $item->id) ? 'active' : '' ?>"
                                           csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                           data-id="<?= $item->id; ?>"
                                           data-type="<?= $item->type === 'vk' ? 'stream' : $item->type?>">
                                            <i class="like-set-icon"></i>
                                            <span class="like-counter"><?= $item->likes ?></span>
                                        </a>

                                        <a href="#" class="views"><?= $item->views ?></a>
                                        <?php if ($item->comment_status === 0): ?>
                                            <?php $countC = 0 ?>
                                        <?php else: ?>
                                            <?php $countC = count($item->comments) ?>
                                        <?php endif; ?>
                                        <a href="#" class="comments">
                                            <?= $countC ?>
                                        </a>

                                    </div>
                                    <?php if ($item->comment_status != 0): ?>

                                        <div class="parser__element--comments-block">

                                            <?php if (!empty($item->comments)): ?>
                                                <?php foreach ($item->comments as $comment_item): ?>
                                                    <div class="avatar">
                                                        <?php if (!empty($comment_item->avatar)): ?>
                                                            <img src="<?= $comment_item->avatar ?>" alt="">
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="name">
                                                        <?= $comment_item->username ?>
                                                    </div>

                                                    <p><?= $comment_item->text ?></p>

                                                    <?php if (!empty($comment_item->photo)): ?>
                                                        <a data-fancybox="gallery" class="parser__element--photo"
                                                           href="<?= $comment_item->photo ?>">
                                                            <img src="<?= $comment_item->photo ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (!empty($comment_item->sticker)): ?>
                                                        <a data-fancybox="gallery" class="parser__element--photo"
                                                           href="<?= $comment_item->sticker ?>">
                                                            <img src="<?= $comment_item->sticker ?>" style="width: 20%">
                                                        </a>
                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>

                    <?php else: ?>
                        <h3>Записей пока нет</h3>
                    <?php endif; ?>

                    <?php if (!empty($model2)): ?>
                        <div id="second-column" class="parser__column">
                            <?php foreach ($model2 as $item): ?>
                                <?php $itemUrl = [
                                        '/stream/default/view',
                                        'slug' => $item->slug,
                                        'social' => Yii::$app->request->get('social'),
                                    ]+($item->type !== 'vk' ? ['type' => $item->type]:[]); ?>
                                <div class="parser__element <?= $item->id ?>">

                                    <a href="<?= \yii\helpers\Url::to($itemUrl) ?>" class="parser__element--author">

                                        <div class="avatar">
                                            <?php if (!empty($item->author->photo)): ?>
                                                <img src="<?= $item->author->photo ?>" alt="">
                                            <?php endif; ?>
                                            <?php if (!empty($item->group)): ?>
                                                <img src="<?= $item->group->photo ?>" alt="">
                                            <?php endif; ?>
                                        </div>

                                        <div class="name">
                                            <?php if (!empty($item->group)): ?>
                                                <?= $item->group->name ?>
                                            <?php endif; ?>

                                            <?php if (!empty($item->author->name)): ?>
                                                <?= $item->author->name ?>
                                            <?php endif; ?>
                                        </div>

                                        <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_publish) ?></span>

                                    </a>

                                    <div class="social-wrap__item">
                                        <img src="/theme/portal-donbassa/img/soc/<?= $item->type ?>.png"
                                             alt="<?= $item->type ?>">
                                    </div>

                                    <!--<h3 class="parser__element--title">F-Secure рассказала об опасностях пиратских версий-->
                                    <!--    Windows</h3>-->

                                    <?php if (!empty($item->text)): ?>

                                        <p class="parser__element--descr"><?= strip_tags($item->text) ?></p>
                                        <?php if (mb_strlen($item->text) > 131): ?>
                                            <a href="<?= \yii\helpers\Url::to($itemUrl) ?>"
                                               class="parser__element--more">читать далее</a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if (!empty($item->photo)): ?>
                                        <a class="parser__element--photo"
                                           href="<?= \yii\helpers\Url::to($itemUrl) ?>">
                                            <img src="<?= $item->photo ?>" alt="">
                                        </a>

                                    <?php elseif (!empty($item->gifPreview)): ?>
                                        <a class="parser__element--photo"
                                           href="<?= \yii\helpers\Url::to($itemUrl) ?>">
                                            <img src="<?= $item->gifPreview ?>" alt="">
                                        </a>

                                    <?php endif; ?>

                                    <div class="parser__element--tools">

                                        <a href="#"
                                           class="like likes <?= User::hasLike($item->type === 'vk' ? 'stream' : $item->type, $item->id) ? 'active' : '' ?>"
                                           csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
                                           data-id="<?= $item->id; ?>"
                                           data-type="<?= $item->type === 'vk' ? 'stream' : $item->type ?>">
                                            <i class="like-set-icon"></i>
                                            <span class="like-counter"><?= $item->getLikesCount() ?></span>
                                        </a>

                                        <a href="#" class="views"><?= $item->views ?></a>

                                        <?php if ($item->comment_status === 0): ?>
                                            <?php $countC = 0 ?>
                                        <?php else: ?>
                                            <?php $countC = count($item->comments) ?>
                                        <?php endif; ?>
                                        <a href="#" class="comments">
                                            <?= $countC ?>
                                        </a>

                                    </div>

                                    <?php if ($item->comment_status != 0): ?>
                                        <div class="parser__element--comments-block">

                                            <?php if (!empty($item->comments)): ?>
                                                <?php foreach ($item->comments as $comment_item): ?>
                                                    <div class="avatar">
                                                        <?php if (!empty($comment_item->avatar)): ?>
                                                            <img src="<?= $comment_item->avatar ?>" alt="">
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="name">
                                                        <?= $comment_item->username ?>
                                                    </div>

                                                    <p><?= $comment_item->text ?></p>

                                                    <?php if (!empty($comment_item->photo)): ?>
                                                        <a data-fancybox="gallery" class="parser__element--photo"
                                                           href="<?= $comment_item->photo ?>">
                                                            <img src="<?= $comment_item->photo ?>" alt="">
                                                        </a>
                                                    <?php endif; ?>

                                                    <?php if (!empty($comment_item->sticker)): ?>
                                                        <a data-fancybox="gallery" class="parser__element--photo"
                                                           href="<?= $comment_item->sticker ?>">
                                                            <img src="<?= $comment_item->sticker ?>" style="width: 20%">
                                                        </a>
                                                    <?php endif; ?>

                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                        </div>
                                    <?php endif; ?>

                                </div>
                            <?php endforeach; ?>
                        </div>


                    <?php else: ?>
                        <h3>Записей пока нет</h3>
                    <?php endif; ?>
                    <!--  <span class="stream-flag"></span>-->
                </div>

                <div class="parser__more">

                    <a href="#" class="show-more show-more-stream" data-last-post-dt="<?= isset($model2[4]->dt_publish)? $model2[4]->dt_publish: $model2[0]->dt_publish ?>"
                       data-dt="" data-step="1"
                       data-type="<?= Yii::$app->request->get('social') ? Yii::$app->request->get('social') : 'all' ?>"
                       csrf-token="<?= Yii::$app->request->getCsrfToken() ?>">загрузить еще</a>

                </div>

            </div>

            <?= \frontend\modules\stream\widgets\ShowTopStream::widget(); ?>
        </div>

    </div>

</section>