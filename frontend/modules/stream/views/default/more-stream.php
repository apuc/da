<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 28.07.2017
 * Time: 15:26
 * @var $model \common\models\db\VkStream
 */
use common\classes\DateFunctions;
use common\models\User;

$itemUrl = [
        '/stream/default/view',
        'slug' => $item->slug,
        'social' => Yii::$app->request->get('social'),
    ]+($item->type !== 'vk' ? ['type' => $item->type]:[]);
?>
<?php /*foreach ($model as $item): */ ?>
    <div class="parser__element <?= $item->id ?>">

        <a href="<?= \yii\helpers\Url::to($itemUrl) ?>"
           class="parser__element--author">

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
            </div>

            <span class="date"><?= DateFunctions::getGetNiceDate($item->dt_publish) ?></span>

        </a>

        <div class="social-wrap__item">
            <img src="/theme/portal-donbassa/img/soc/<?= $item->type ?>.png" alt="<?= $item->type ?>">
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
                <img class="img-last-stream" src="<?= $item->photo ?>" alt="">
            </a>

        <?php elseif (!empty($item->gifPreview)): ?>
            <a class="parser__element--photo"
               href="<?= \yii\helpers\Url::to($itemUrl) ?>">
                <img class="img-last-stream" src="<?= $item->gifPreview ?>" alt="">
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
                <?= ($item->comment_status) ? count($item->comments) : 0 ?>
            </a>

        </div>
        <?php if ($item->comment_status) : ?>
        <div class="parser__element--comments-block">

            <?php if (!empty($item->all_comments)): ?>
                <?php foreach ($item->all_comments as $comment_item): ?>
                    <div class="avatar">
                        <img src="<?= $comment_item->avatar ?>" alt="">
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
            <?php endif; ?>
        </div>

    </div>
<?php /*endforeach; */ ?>