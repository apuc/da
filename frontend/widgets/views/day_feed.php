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
            <div href="" class="tape__item">
                <span class="time"><?= date('H:i', $new->dt_public) ?></span>
                <div class="hide-social">
                    <a href=""><i class="fa fa-vk  fa-lg"></i></a>
                    <a href=""><i class="fa fa-twitter fa-lg"></i></a>
                    <a href=""><i class="fa fa-facebook fa-lg"></i></a>
                    <a href=""><i class="fa fa-odnoklassniki  fa-lg"></i></a>

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