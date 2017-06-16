<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 15:58
 * @var $posters \common\models\db\Poster
 */
use common\classes\WordFunctions;
use yii\helpers\Url;
if(!empty($posters)):
?>
<div class="what-to-see">
    <h3>Что посмотреть</h3>
    <div class="afisha-events__wrap">
        <?php foreach ($posters as $poster): ?>
            <a href="<?= Url::to(['/poster/default/view', 'slug'=>$poster->slug]) ?>" class="item">
                <img src="<?= $poster->photo ?>" alt="">
                <div class="item-content">
                    <span class="type"><?= $poster->categories[0]->title ?></span>
                    <span class="name-item"><?= $poster->title ?></span>
                    <span class="time">
                        <?= WordFunctions::dateWithMonts($poster->dt_event) ?>, <?= date('H:i',$poster->dt_event) ?>
                    </span>
                </div>
            </a>
        <?php endforeach; ?>
        <span id="more-kino-box"></span>
    </div>

    <?php if($countPoster > 4): ?>
        <a href="" id="load-more-kino" data-step="2" class="show-more">загрузить БОЛЬШЕ</a>
    <?php endif;?>
</div>

<?php endif;