
<section class="photo">

    <div class="container">

        <a href="#" class="photo__trigger"><?= $content->title;?></a>

        <div class="photo__box">

            <div class="photo__left">
                <a href="<?= $photos[0]  . '?width=300'?>" class="photo__left--item" data-fancybox="gallery">
                    <img src="<?= $photos[0] . '?width=300'?>" alt="photo">
                </a>
                <a href="<?= $photos[1]  . '?width=300'?>" class="photo__left--item" data-fancybox="gallery">
                    <img src="<?= $photos[1] . '?width=300'?>" alt="photo">
                </a>
            </div>
            <div class="photo__center">

                <h3><?= $content->title;?></h3>

                <p><?= $content->description;?></p>

                <a href="<?= $photos[2] . '?width=300'?>" class="photo__center--img" data-fancybox="gallery">
                    <img src="<?= $photos[2] . '?width=300'?>" alt="">
                </a>

                <div class="photo__center--imgs">

                    <a href="<?= $photos[3]  . '?width=300'?>" class="photo__center--img" data-fancybox="gallery">
                        <img src="<?= $photos[3] . '?width=300'?>" alt="">
                    </a>
                    <a href="<?= $photos[4] . '?width=300'?>" class="photo__left--item" data-fancybox="gallery">
                        <img src="<?= $photos[4] . '?width=300'?>" alt="">
                    </a>
                    <a href="<?= $photos[5] . '?width=300'?>" class="photo__center--img" data-fancybox="gallery">
                        <img src="<?= $photos[5] . '?width=300'?>" alt="">
                    </a>

                </div>

            </div>
            <div class="photo__right">

                <a href="<?= $photos[6] . '?width=300'?>" class="photo__right--item" data-fancybox="gallery">
                    <img src="<?= $photos[6] . '?width=300'?>" alt="photo">
                </a>
                <a href="<?= $photos[7] . '?width=300'?>" class="photo__right--item" data-fancybox="gallery">
                    <img src="<?= $photos[7] . '?width=300'?>" alt="photo">
                </a>
                <a href="<?= $photos[8] . '?width=300'?>" class="photo__right--item" data-fancybox="gallery">
                    <img src="<?= $photos[8] . '?width=300'?>" alt="photo">
                </a>

            </div>

        </div>

    </div>

</section>