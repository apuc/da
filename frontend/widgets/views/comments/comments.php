<?php
//\common\classes\Debug::prn($comments);
?>

<div class="comments-wrapper">

    <div class="after-comments">
        <?php if ($postType == 'news'): ?>
            <h2>Комментарии к новости</h2>
        <?php elseif ($postType == 'page'): ?>
            <h2>Комментарии к <?= $pageTitle ?></h2>
        <?php endif; ?>

        <a href="#" class="populiation">Популярные впереди</a>
        <a data-post-type="<?= $postType; ?>"
           data-post-id="<?= $postId; ?>"
           data-parent-id="0"
           href="#" class='add-comment'>Написать свой</a>
    </div>

    <div class="comments">

        <?= $comments; ?>


        <?php /*foreach ($comments as $comment): */?><!--
            <div class="comment-wrapper <?/*= ($comment->moder_checked) ? ' moder' : ''; */?>">
                <div class="user">
                    <div class="user-photo">
                        <?/*= \common\classes\UserFunction::getUser_avatar_html((!empty($comment->user_id)) ? $comment->user_id : 0)*/?>
                    </div>

                </div>
                <div class="comment">
                    <div class="comment-info-wrapper">

                        <div class="user-name">
                            <?php /*if(!empty($comment->user->username)): */?>
                                <?/*= $comment->user->username; */?>
                            <?php /*else: */?>
                                Гость
                            <?php /*endif; */?>
                        </div>

                        <div class="comment-info">
                            <?/*= ($comment->moder_checked) ? '<div class="modern-comment">Выделен модератором</div>' : ''; */?>
                            <a data-post-type="<?/*= $postType; */?>"
                               data-post-id="<?/*= $postId; */?>"
                               data-parent-id="<?/*= $comment->id; */?>" class="add-comment" href="#">Ответить</a>
                            <div class="time"><?/*= \common\classes\WordFunctions::getTimeOrDateTime($comment->dt_add); */?></div>
                        </div>
                    </div>

                    <div class="text">
                        <?/*= $comment->content; */?>
                    </div>

                    <?php /*if(!empty($comment['childComments'])):
                        foreach ($comment['childComments'] as $childComment):
                            // \common\classes\Debug::prn($childComment->user_id);
                    */?>
                        <div class="child-comment">
                            <div class="user">

                                <div class="user-photo">
                                    <?/*= \common\classes\UserFunction::getUser_avatar_html((!empty($childComment->user_id)) ? $childComment->user_id : 0)*/?>
                                </div>


                            </div>
                            <div class="comment">
                                <div class="comment-info-wrapper">
                                    <div class="user-name">
                                        <?php /*if(!empty($childComment->user->username)): */?>
                                            <?/*= $childComment->user->username; */?>
                                        <?php /*else: */?>
                                            Гость
                                        <?php /*endif; */?>
                                    </div>


                                    <div class="comment-info">
                                        <a data-post-type="<?/*= $postType; */?>"
                                           data-post-id="<?/*= $postId; */?>"
                                           data-parent-id="<?/*= $childComment->id; */?>" class="add-comment" href="#">Ответить</a>
                                        <div class="time"><?/*= \common\classes\WordFunctions::getTimeOrDateTime($childComment->dt_add); */?></div>
                                    </div>
                                </div>

                                <div class="text"><?/*= $childComment->content*/?></div>
                            </div>
                        </div>
                        <?php /*endforeach; */?>
                    <?php /*endif; */?>
                </div>
            </div>
        --><?php /*endforeach;*/?>

    </div>
</div>

