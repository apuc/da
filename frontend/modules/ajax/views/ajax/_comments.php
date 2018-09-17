<?php
use common\classes\DateFunctions;
use common\models\User;

?>
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

