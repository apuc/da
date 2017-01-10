<?php
/**
 * @var $key_value array
 */
use common\classes\DateFunctions;
use common\models\User;

?>
<div class="comments">

    <div class="comments-count">
        <span class="count-value"><?= $count_comments; ?></span>
        <!--        <span>коментариев</span>-->
        <span>
            <?= \common\classes\WordFunctions::getNumEnding( $count_comments, [
                'комментарий',
                'комментария',
                'комментариев'
            ] ); ?>
        </span>
    </div>

    <?php if ( ! Yii::$app->user->isGuest ) { ?>
        <h4 class="form-title">Что Вы об этом думаете?</h4>
        <form class="comments-form">
            <textarea id="new-comment" cols="30" rows="10"></textarea>
            <input id="send_comment" type="submit" value="ОТПРАВИТЬ">
        </form>
    <?php } else { ?>
        <h4 class="form-title">Что бы оставлять комментарии, войдите или зарегестрируйтесь.</h4>
    <?php }; ?>
    <div class="comments-content">
        <?php foreach ( $comments as $comment ): ?>
            <div class="single-comment">
                <span class="nickname"><?= User::find()
                                               ->where( [ 'id' => $comment->user_id ] )
                                               ->one()
                        ->username; ?>
                </span>
                    <span
                        class="date"><?= DateFunctions::getRealStringDate( date( 'd.m.Y', $comment->dt_add ) ) . ' ' . date( 'H:i', $comment->dt_add ); ?></span>
                <p class="content"><?= $comment->content; ?></p>
            </div>
        <?php endforeach; ?>

    </div>
    <a data-time="<?= time(); ?>" data-id="<?= $post_id; ?>" data-type="<?= $post_type; ?>" data-count="5"
       data-limit="5"
       class="more more-comments">Показать еще</a>
</div>
