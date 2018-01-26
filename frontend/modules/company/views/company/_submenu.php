<?php
/**
 * @var $model \common\models\db\Company
 * @var string $slug
 */

use common\classes\CompanyFunction;
use yii\helpers\Url;

?>
<a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'about']) ?>">
    О компании
</a>
<a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'reviews']) ?>">
    Отзывы
    <span class="tabs-counters">
                <?= CompanyFunction::getCountReviews($model->id); ?>
            </span>
</a>
<a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'stocks']) ?>">
    Акции
    <span class="tabs-counters">
                <?= CompanyFunction::getCountStock($model->id); ?>
            </span>
</a>
<a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'statistics']) ?>">
    Статистика
</a>
<a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => 'map']) ?>">
    Карта
</a>
<ul class="business__tab-links">

    <li class="tab active">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => '_about']) ?>">
            О компании
        </a>
    </li>
    <li class="tab">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => '_reviews']) ?>">
            Отзывы
            <span class="tabs-counters">
                <?= CompanyFunction::getCountReviews($model->id); ?>
            </span>
        </a>
    </li>
    <li class="tab">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => '_stocks']) ?>">
            Акции
            <span class="tabs-counters">
                <?= CompanyFunction::getCountStock($model->id); ?>
            </span>
        </a>
    </li>
    <li class="tab">
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => '_statistics']) ?>">
            Статистика
        </a>
    </li>
    <li>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $slug, 'page' => '_map']) ?>">
            Карта
        </a>
    </li>
</ul>