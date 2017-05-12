<h2>ЛЕНТА ДНЯ</h2>
<div class="home-content__tape_wrap">
    <?php
    use common\classes\WordFunctions;

    $newImageId = 0;
    foreach ($news as $key => $new):
        if ($key == $newImageId) {
            ?>
            <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>" class="tape__item_pic">
                <span class="time"><?= date('d.m H:i', $new->dt_public) ?></span>
                <img src="<?= $new->photo; ?>" alt="">
                <p><?= $new->title; ?></p>
            </a>
            <?php
            $newImageId += 4;
        } else {
        //For share
            $new_url   = \yii\helpers\Url::base( true ) . \yii\helpers\Url::to();
            $new_title = strip_tags( $new->title );
            $new_title = preg_replace( "/\s{2,}/", " ", $new_title );
            $new_title = str_replace( '"', "&quot;", $new_title );
            $new_img   = 'http://' . $_SERVER['HTTP_HOST'] . $new->photo;

            $count_symbols = 800 - 48 - strlen( $new_url ) - strlen( $new_title ) - strlen( $new_img );
            $new_content  = strip_tags( $new->content );
            $new_content  = preg_replace( "/\s{2,}/", " ", $new_content );

            $new_content = substr( $new_content, 0, $count_symbols ) . '...';

            ?>
            <div href="" class="tape__item">
                <span class="time"><?= date('H:i', $new->dt_public) ?></span>
                <div class="hide-social">
                    <a onclick="Share.vkontakte(
                            '<?= $new_url ?>',
                            '<?= $new_title; ?>',
                            '<?= $new_img; ?>',
                            '<?= $new_content; ?>'
                            ); return false;" href=""><i class="fa fa-vk  fa-lg"></i></a>
                    <a onclick="Share.twitter('<?= $new_url ?>',
                            '<?= $new_title ?>')" href=""><i class="fa fa-twitter fa-lg"></i></a>
                    <a onclick="Share.facebook(
                            '<?= $new_url ?>',
                            '<?= $new_title; ?>',
                            '<?= $new_img; ?>',
                            '<?= $new_content; ?>')" href=""><i class="fa fa-facebook fa-lg"></i></a>
                    <a onclick="Share.odnoklassniki(
                            '<?= $new_url ?>',
                            '<?= $new_title; ?>'
                            )" href=""><i class="fa fa-odnoklassniki  fa-lg"></i></a>

                </div>
                <span class="open-soc"><i class="fa fa-random fa-lg"></i></span>
                <h4>
                    <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>">
                        <?= $new->title; ?>
                    </a>
                </h4>

                <!-- <p>Донбас - 2017 названы три сценариявозможного будущего оккупированных территорий</p> -->
            </div>
            <?php
        }
        ?>


    <?php endforeach; ?>


    <a href="<?= \yii\helpers\Url::to(['/news/news']) ?>" class="more_type">смотреть все новости</a>
</div>