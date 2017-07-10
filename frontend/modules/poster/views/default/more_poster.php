<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 15:17
 * @var $posters \common\models\db\Poster
 */
use common\classes\DateFunctions;
use common\classes\WordFunctions;
use yii\helpers\Url;

?>
<?php foreach ($posters as $poster): ?>
    <a href="<?= Url::to(['/poster/default/view', 'slug'=>$poster->slug]) ?>" class="item">
        <div class="thumb">
            <img src="<?= $poster->photo ?>" alt="">
        </div>
        <div class="contents">
            <span class="type">
                <?= isset($poster->categories[0]) ? $poster->categories[0]->title : '' ?>
            </span>
            <h3 style="padding-left: 0"><?= WordFunctions::crop_str_word($poster->title, 6)  ?></h3>
            <span class="date">
                        <?php
                        if(date('d-m',$poster->dt_event) == date('d-m',$poster->dt_event_end)):
                            ?>
                            <?= date('d',$poster->dt_event) . ' '.DateFunctions::getMonthName(date('m',$poster->dt_event))?>
                            <?php
                        else:
                            ?>
                            <?= date('d',$poster->dt_event) . ' '.DateFunctions::getMonthName(date('m',$poster->dt_event))?> -
                            <?= date('d',$poster->dt_event_end) . ' '.DateFunctions::getMonthName(date('m',$poster->dt_event_end))?>
                            <?php
                        endif;
                        ?>


                <?/*= WordFunctions::dateWithMonts($poster->dt_event) */?><!--, --><?/*= $poster->start; */?>
                    </span>
            <span class="place"><?= $poster->address ?></span>
        </div>
    </a>
<?php endforeach; ?>
