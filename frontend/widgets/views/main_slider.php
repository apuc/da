<?php

/**
 * @var array $news
 * @var News $new
 */

use \common\models\db\News;

?>

<div class="home-content__wrap_slider">
    <?php foreach ($news as $new): ?>
        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>" class="item" title="<?= $new->title?>">

            <img src="<?= $new->photo . '?width=600' ?>"
                 alt="<?= !empty($new->alt) ? $new->alt : $new->title ?>">

            <div class="content">
                <div class="content-row">

                    <span><?= \frontend\widgets\MainSlider::getDateNew($new->dt_public); ?></span>
                    <span><?= $new['categoryNewsRelations'][0]['cat']->title; ?></span>
                    <span><small class="view-icon"></small><?= $new->views; ?></span>
                    <span><small class="comments-icon"></small><?= News::getCommentsCount($new->id) ?></span>

                    <?php
                    $new_url = \yii\helpers\Url::base(true) . '/news/' . $new->slug;
                    $new_title = strip_tags($new->title);
                    $new_title = preg_replace("/\s{2,}/", " ", $new_title);
                    $new_title = str_replace('"', "&quot;", $new_title);
                    $new_img = 'http://' . $_SERVER['HTTP_HOST'] . $new->photo . '?width=300';

                    //$count_symbols = 800 - 48 - strlen($new_url) - strlen($new_title) - strlen($new_img);
                    $count_symbols = 800 - 110 - strlen($new_url) - strlen($new_title) - strlen($new_img);
                    $new_content = strip_tags($new->content);
                    $new_content = preg_replace("/\s{2,}/", " ", $new_content);

                    $new_content = mb_substr($new_content, 0, $count_symbols) . '...';
                    ?>

                    <div class="hide-social">
                        <span onclick="Share.vkontakte(
                                '<?= $new_url ?>',
                                '<?= $new_title; ?>',
                                '<?= $new_img; ?>',
                                '<?= $new_content; ?>'
                                ); return false;"><i class="fa fa-vk  fa-lg"></i></span>
                        <span onclick="Share.twitter('<?= $new_url ?>',
                                '<?= $new_title ?>')"><i class="fa fa-twitter fa-lg"></i></span>
                        <span onclick="Share.facebook(
                                '<?= $new_url ?>',
                                '<?= $new_title; ?>',
                                '<?= $new_img; ?>',
                                '<?= $new_content; ?>')"><i class="fa fa-facebook fa-lg"></i></span>
                        <span onclick="Share.odnoklassniki(
                                '<?= $new_url ?>',
                                '<?= $new_title; ?>'
                                )"><i class="fa fa-odnoklassniki  fa-lg"></i></span>
                    </div>
                    <span class="open-soc"><i class="fa fa-random fa-lg"></i></span>
                </div>
                <h3><?= $new->title; ?></h3>
                <p><?= strip_tags($new->content) ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>