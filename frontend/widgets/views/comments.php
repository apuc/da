<?php

?>
<div class="comments-wrapper">

    <div class="after-comments">
        <h2>Комментарии к новости</h2>

        <a href="#" class="populiation">Популярные впереди</a><a href="#" class='add-comment'>Написать свой</a>
    </div>

    <div class="comments">
        <!--<div class="comment-wrapper moder">-->
        <!--    <div class="user">-->
        <!--        <span>12</span>-->
        <!--        <div class="user-photo">-->
        <!--            <img src="img/users-avatars/1.jpg" alt="">-->
        <!--        </div>-->
        <!---->
        <!--        <a href="#" class="up"></a>-->
        <!--        <a href="#" class="down"></a>-->
        <!--    </div>-->
        <!--    <div class="comment">-->
        <!--        <div class="comment-info-wrapper">-->
        <!--            <div class="user-name">Кирилл Кириленко</div>-->
        <!---->
        <!--            <div class="comment-info">-->
        <!--                <div class="modern-comment">Выделен модератором</div>-->
        <!--                <a href="#">Ответить</a>-->
        <!--                <div class="time">16:43:12</div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!---->
        <!--        <div class="text">-->
        <!--            Также хотят запретить выезд из страны имеющим судимость за «экстремизм» и вводить режим КТО в случаях «посягательства на жизнь государственного или общественного деятеля», «насильственного захвата власти», «вооруженного мятежа»-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <?php foreach ($comments as $comment): ?>
            <div class="comment-wrapper<?= ($comment->moder_checked)? ' moder':'';?>">
                <div class="user">
                    <span>12</span>
                    <div class="user-photo">
                        <img src="/theme/portal-donbassa/img/users-avatars/no-avatar.png" alt="">
                    </div>

                    <a href="#" class="up"></a>
                    <a href="#" class="down"></a>
                </div>
                <div class="comment">
                    <div class="comment-info-wrapper">
                        <div class="user-name"><?= $comment->user->username; ?></div>

                        <div class="comment-info">
                            <a href="#">Ответить</a>
                            <div class="time"><?= \common\classes\WordFunctions::getTimeOrDateTime($comment->dt_add); ?></div>
                        </div>
                    </div>

                    <div class="text">
                        <?= $comment->content; ?>
                    </div>
                    <?php
                    if (!empty($comment->childComments)):
                        foreach ($comment->childComments as $childComment):
                            ?>
                            <div class="child-comment<?= ($childComment->moder_checked)? ' moder':'';?>">
                                <div class="user">
                                    <span>12</span>

                                    <div class="user-photo">
                                        <img src="/theme/portal-donbassa/img/users-avatars/no-avatar.png" alt="">
                                    </div>

                                    <a href="#" class="up"></a>
                                    <a href="#" class="down"></a>
                                </div>
                                <div class="comment">
                                    <div class="comment-info-wrapper">
                                        <div class="user-name"><?= $childComment->user->username; ?></div>
                                        <!--<div class="moder">Модератор</div>-->

                                        <div class="comment-info">
                                            <a href="#">Ответить</a>
                                            <div class="time"><?= \common\classes\WordFunctions::getTimeOrDateTime($childComment->dt_add); ?></div>
                                        </div>
                                    </div>

                                    <div class="text"><?= $childComment->content ?></div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <!---->
        <!--<div class="comment-wrapper">-->
        <!--    <div class="user">-->
        <!--        <span>12</span>-->
        <!--        <div class="user-photo">-->
        <!--            <img src="img/users-avatars/1.jpg" alt="">-->
        <!--        </div>-->
        <!---->
        <!--        <a href="#" class="up"></a>-->
        <!--        <a href="#" class="down"></a>-->
        <!--    </div>-->
        <!--    <div class="comment">-->
        <!--        <div class="comment-info-wrapper">-->
        <!--            <div class="user-name">Кирилл Кириленко</div>-->
        <!---->
        <!--            <div class="comment-info">-->
        <!--                <a href="#">Ответить</a>-->
        <!--                <div class="time">16:43:12</div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!---->
        <!--        <div class="text">-->
        <!--            Также хотят запретить выезд из страны имеющим судимость за «экстремизм» и вводить режим КТО в случаях «посягательства на жизнь государственного или общественного деятеля», «насильственного захвата власти», «вооруженного мятежа»-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

        <a href="#" class="load-more">загрузить БОЛЬШЕ</a>

    </div>
</div>

