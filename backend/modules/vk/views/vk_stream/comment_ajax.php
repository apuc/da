<?php foreach($comments as $comment):?>
    <tr>
        <?php if(!empty($comment->group)): ?>
        <td class="col-sm-2"><img src=" " class="img-rounded">
            <a href="https://vk.com/<?= $comment->group['link'] ?>" target="_blank">
               <?= $comment->group['name'] ?> </a></img></td>
        <?php else: ?>
            <td class="col-sm-2"><img src=" <?= $comment->author->photo ?> " class="img-rounded">
                <a href="https://vk.com/<?= $comment->author->screen_name ?>" target="_blank">
                    <?= $comment->author->first_name.' '.$comment->author->last_name ?> </a></img></td>
        <?php endif;?>

        <td> <?= $comment->text ?>
            <?php if(!empty($comment->img)): ?>
                <img src="<?= $comment->img?>">
            <?php endif;?>

            <?php if(!empty($comment->sticker)): ?>
                <div>
                    <img src="<?= $comment->sticker?>">
                </div>
            <?php endif;?>
        </td>

        <td class="col-sm-1"> <?= $comment->dt_add ?></td>

        <td><a href="#" data-id="<?= $comment->id ?>" class="delete_comments">
                <span class="glyphicon glyphicon-trash"></span>
            </a>
        </td>
    </tr>
<?php endforeach;?>
