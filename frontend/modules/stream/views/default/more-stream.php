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

?>
<?php foreach ($model as $item): ?>
    <div class="parser__element <?= $item->id ?>">

        <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'id' => $item->id])?>" class="parser__element--author">

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
                <?= count($item->comments) ?>
            </a>

        </div>

        <div class="parser__element--comments-block">

            <?php if (!empty($item->comments)): ?>
                <?php foreach ($item->comments as $comment): ?>
                    <div class="avatar">
                        <img src="<?= $comment->author->photo ?>" alt="">
                    </div>

                    <div class="name">
                        <?= $comment->author->first_name . ' ' . $comment->author->last_name ?>
                    </div>

                    <p><?= $comment->text ?></p>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

    </div>
<?php endforeach; ?>