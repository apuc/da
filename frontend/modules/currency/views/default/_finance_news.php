<?php
/**
 * @var array $economicNews
 * @var News $economicNew
 */

use yii\helpers\Url;
use common\models\db\News;

?>

<div class="currency-news">
    <h3 class="currency-news__title">
        Финансовые новости недели
    </h3>
    <div class="currency-news__wrapper">
        <?php foreach ($economicNews as $economicNew) : ?>
            <a class="currency-news__item"
               href="<?= Url::to(['/news/default/view', 'slug' => $economicNew->slug]) ?>">
                <div class="currency-news__img">
                    <img src="<?= $economicNew->photo ?>"
                         alt="<?= !empty($economicNew->alt) ? $economicNew->alt : $economicNew->title ?>">
                </div>
                <div class="currency-news--date">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <span>
                        <?= Yii::$app->formatter->asDate($economicNew->dt_public, 'long'); ?>
                        <?= date('H:i', $economicNew->dt_public) ?>
                    </span>
                </div>
                <div class="currency-news--text">
                    <p><?= $economicNew->title ?></p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>