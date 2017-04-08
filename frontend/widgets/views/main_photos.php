

<section class="photo">

    <div class="container">

        <a href="#" class="photo__trigger"><?= $content->title;?></a>

        <div class="photo__box">

            <div class="photo__left">
                <a href="<?= $photos[0];?>" class="photo__left--item"
                   data-lightbox="image-group">
                    <img src="<?= $photos[0];?>" alt="photo">
                </a>
                <a href="<?= $photos[1];?>" class="photo__left--item"
                   data-lightbox="image-group">
                    <img src="<?= $photos[1];?>" alt="photo">
                </a>
            </div>
            <div class="photo__center">

                <h3><?= $content->title;?></h3>

                <p><?= $content->description;?></p>

                <a href="<?= $photos[2];?>" class="photo__center--img"
                   data-lightbox="image-group">
                    <img src="<?= $photos[2];?>" alt="">
                </a>

                <div class="photo__center--imgs">

                    <a href="<?= $photos[3];?>" class="photo__center--img"
                       data-lightbox="image-group">
                        <img src="<?= $photos[3];?>" alt="">
                    </a>
                    <a href="<?= $photos[4];?>" class="photo__left--item"
                       data-lightbox="image-group">
                        <img src="<?= $photos[4];?>" alt="">
                    </a>
                    <a href="<?= $photos[5];?>" class="photo__center--img"
                       data-lightbox="image-group">
                        <img src="<?= $photos[5];?>" alt="">
                    </a>

                </div>

            </div>
            <div class="photo__right">

                <a href="<?= $photos[6];?>" class="photo__right--item"
                   data-lightbox="image-group">
                    <img src="<?= $photos[6];?>" alt="photo">
                </a>
                <a href="<?= $photos[7];?>" class="photo__right--item"
                   data-lightbox="image-group">
                    <img src="<?= $photos[7];?>" alt="photo">
                </a>
                <a href="<?= $photos[8];?>" class="photo__right--item"
                   data-lightbox="image-group">
                    <img src="<?= $photos[8];?>" alt="photo">
                </a>

            </div>

        </div>

    </div>

</section>