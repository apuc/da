<h2>ЛЕНТА ДНЯ</h2>
<div class="home-content__tape_wrap">
    <?php
    use common\classes\WordFunctions;

    $newImageId = 0;
    foreach ($news as $key => $new):
        if ($key == $newImageId) {
            ?>
            <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>" class="tape__item_pic">
                <span class="time"><?= date('Y-m-d H:i', $new->dt_public) ?></span>
                <img src="<?= $new->photo; ?>" alt="">
                <p><?= $new->title; ?></p>
            </a>
            <?php
            $newImageId += 4;
        } else {
            ?>
            <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>" class="tape__item">
                <span class="time"><?= date('H:i', $new->dt_public) ?></span><h4><?= $new->title; ?></h4>
                <!--<p>--><?//= WordFunctions::crop_str_word( strip_tags( $new->content ), 10 );?><!--</p>-->
                <?php $content = explode('<div style="page-break-after: always"><span style="display:none">&nbsp;</span></div>',
                    $new->content);
                if (!empty($content[0]) && count($content) > 1):?>
                    <p><?= strip_tags($content[0]); ?></p>
                <?php else: ?>
                    <p><?= WordFunctions::crop_str_word(strip_tags($new->content), 10); ?></p>
                <?php endif; ?>
            </a>
            <?php
        }
        ?>


    <?php endforeach; ?>


    <a href="" class="more_type">смотреть все новости</a>
</div>