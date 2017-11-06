<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 30.03.2017
 * Time: 16:09
 * @var $posters \common\models\db\Poster
 */
use common\classes\DateFunctions;
use yii\helpers\Url;
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<section class="afisha-top-slider">
    <div class="container">
        <div class="afisha-top-slider__wrap">
            <?php foreach ($posters as $poster): ?>
                <!-- item -->
                <a  href="<?= Url::to(['/poster/default/view', 'slug' => $poster->slug]) ?>"  class="afisha-top-slider__wrap_item">
                    <div class="thumb">
                        <img src="<?= $poster->photo ?>" alt="">
                    </div>
                    <div class="contents contents-grey">
                        <div class="contents-date">
                            <span class="number-day"><?= date('d', $poster->dt_event) ?></span>
                            <span class="mounth"><?= DateFunctions::getMonthShortName(date('m', $poster->dt_event)) ?></span>
                        </div>
                        <!--<p><?/*= $poster->title */?></p>-->
                        <span class="place"><?= $poster->title ?></span>
                    </div>
                </a>
                <!-- item -->
            <?php endforeach; ?>
        </div>
    </div>
</section>
