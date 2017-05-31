
<section class="photo">

    <div class="container">

        <a href="#" class="photo__trigger"><?= $content->title;?></a>

        <div class="photo__box">

            <div class="photo__left">
                <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[0]);?>" class="photo__left--item" data-fancybox="gallery">
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[0]);?>" alt="photo">
                </a>
                <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[1]);?>" class="photo__left--item" data-fancybox="gallery">
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[1]);?>" alt="photo">
                </a>
            </div>
            <div class="photo__center">

                <h3><?= $content->title;?></h3>

                <p><?= $content->description;?></p>

                <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[2]);?>" class="photo__center--img" data-fancybox="gallery">
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[2]);?>" alt="">
                </a>

                <div class="photo__center--imgs">

                    <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[3]);?>" class="photo__center--img" data-fancybox="gallery">
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[3]);?>" alt="">
                    </a>
                    <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[4]);?>" class="photo__left--item" data-fancybox="gallery">
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[4]);?>" alt="">
                    </a>
                    <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[5]);?>" class="photo__center--img" data-fancybox="gallery">
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[5]);?>" alt="">
                    </a>

                </div>

            </div>
            <div class="photo__right">

                <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[6]);?>" class="photo__right--item" data-fancybox="gallery">
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[6]);?>" alt="photo">
                </a>
                <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[7]);?>" class="photo__right--item" data-fancybox="gallery">
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[7]);?>" alt="photo">
                </a>
                <a href="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[8]);?>" class="photo__right--item" data-fancybox="gallery">
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($photos[8]);?>" alt="photo">
                </a>

            </div>

        </div>

    </div>

</section>