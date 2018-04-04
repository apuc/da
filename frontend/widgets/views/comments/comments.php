<?php

/**
 * @var string $postType
 * @var string $pageTitle
 * @var string $comments
 * @var int $postId
 */
?>

<div class="comments-wrapper">
    <div class="after-comments">
        <h2><?= $pageTitle ?></h2>
        <a href="#" class="populiation">Популярные впереди</a>
        <a data-post-type="<?= $postType; ?>"
           data-post-id="<?= $postId; ?>"
           data-parent-id="0"
           href="#" class='add-comment'>Написать свой</a>
    </div>
    <div class="comments">
        <?= $comments; ?>
    </div>
</div>

