<?php
/**
 * @var $model \common\models\db\Company
 * @var string $slug
 */

use common\classes\CompanyFunction;
use yii\helpers\Url;

?>
<ul class="business__tab-links">

    <li class="tab active">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug]) ?>">
            О компании
        </a>
    </li>
    <li class="tab">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'reviews']) ?>">
            Отзывы
            <span class="tabs-counters">
                <?= CompanyFunction::getCountReviews($model->id); ?>
            </span>
        </a>
    </li>
    <li class="tab">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'stocks']) ?>">
            Акции
            <span class="tabs-counters">
                <?= CompanyFunction::getCountStock($model->id); ?>
            </span>
        </a>
    </li>
    <li class="tab">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'statistics']) ?>">
            Статистика
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'map']) ?>">
            Карта
        </a>
    </li>
</ul>