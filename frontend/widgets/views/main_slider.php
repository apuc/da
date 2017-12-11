<div class="home-content__wrap_slider">
    <?php foreach ($news as $new): ?>
        <!--<div class="item">
            <a href="<?/*= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); */?>">
                <img src="<?/*= $new->photo; */?>" alt="">
            </a>
            <div class="content">
                <div class="content-row">
                    <span><?/*= \frontend\widgets\MainSlider::getDateNew($new->dt_public); */?></span>
                    <a href="/news">Новости</a>
                    <span><small class="view-icon"></small> <?/*= $new->views; */?></span>
                </div>
                <h3><?/*= $new->title; */?></h3>
            </div>
        </div>-->

        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>" class="item">

            <img src="<?= $new->photo . '?width=600' ?>" alt="">

            <div class="content">
                <div class="content-row">

                    <span><?= \frontend\widgets\MainSlider::getDateNew($new->dt_public); ?></span>
                    <span><?= $new['categoryNewsRelations'][0]['cat']->title; ?></span>
                    <span><small class="view-icon"></small><?= $new->views; ?></span>
                    <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($new->id)?></span>

                    <?php
                    $new_url = \yii\helpers\Url::base(true) . '/news/' . $new->slug;
                    $new_title = strip_tags($new->title);
                    $new_title = preg_replace("/\s{2,}/", " ", $new_title);
                    $new_title = str_replace('"', "&quot;", $new_title);
                    $new_img = 'http://' . $_SERVER['HTTP_HOST'] . $new->photo;

                    //$count_symbols = 800 - 48 - strlen($new_url) - strlen($new_title) - strlen($new_img);
                    $count_symbols = 800 - 48 - strlen($new_url) - strlen($new_title) - strlen($new_img);
                    $new_content = strip_tags($new->content);
                    $new_content = preg_replace("/\s{2,}/", " ", $new_content);

                    $new_content = substr($new_content, 0, $count_symbols) . '...';
                    ?>

                    <div class="hide-social">
                        <span onclick="Share.vkontakte(
                            '<?= $new_url ?>',
                            '<?= $new_title; ?>',
                            '<?= $new_img; ?>',
                            '<?= $new_content; ?>'
                            ); return false;" href=""><i class="fa fa-vk  fa-lg"></i></span>
                        <span onclick="Share.twitter('<?= $new_url ?>',
                            '<?= $new_title ?>')" href=""><i class="fa fa-twitter fa-lg"></i></span>
                        <span onclick="Share.facebook(
                            '<?= $new_url ?>',
                            '<?= $new_title; ?>',
                            '<?= $new_img; ?>',
                            '<?= $new_content; ?>')" href=""><i class="fa fa-facebook fa-lg"></i></span>
                        <span onclick="Share.odnoklassniki(
                            '<?= $new_url ?>',
                            '<?= $new_title; ?>'
                            )" href=""><i class="fa fa-odnoklassniki  fa-lg"></i></span>

                    </div>
                    <span class="open-soc"><i class="fa fa-random fa-lg"></i></span>
                </div>
                <h3><?= $new->title; ?></h3>
                <p><?= strip_tags($new->content) ?></p>
            </div>


            <!--<div class="content">
                <div class="content-row">
                    <span><?/*= \frontend\widgets\MainSlider::getDateNew($new->dt_public); */?></span>
                    <span>Новости</span>
                    <span> <?/*= $new->views; */?></span>
                </div>
                <h3><?/*= $new->title; */?></h3>
                <p><?/*= strip_tags($new->content) */?></p>
            </div>-->
        </a>
    <?php endforeach; ?>
</div>