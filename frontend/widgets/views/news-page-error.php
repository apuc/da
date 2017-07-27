<?php
    if(!empty($news)):
?>

        <h3 class="main-title">Рекомендуем почитать</h3>

        <div class="dev__elements--news">

            <?php foreach ($news as $item): ?>
                <a href="<?= \yii\helpers\Url::to(['/news/default/view', 'slug' => $item->slug])?>" class="news__wrap_item-sm-hot">
                <!-- thumb -->
                <div class="thumb">

                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo) ?>" alt="">

                </div>
                <!-- thumb -->
                <div class="hover-wrap">
                    <!--<span class="category"><span class="category-star"></span>ГОРЯЧЕЕ</span>-->
                    <h2><?= $item->title; ?></h2>
                </div>

            </a>
            <?php endforeach; ?>
        </div>

<?php
    endif;
