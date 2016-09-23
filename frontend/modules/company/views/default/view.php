<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.09.2016
 * Time: 11:53
 * @var $company \common\models\db\Company
 */
use common\classes\DateFunctions;

$this->title = $company->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $company->meta_descr,
]);
?>
<div class="shape">
    <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
</div>
<div class="news__post">
    <span class="date-news__post"><?= date('d', $company->dt_add) ?> <?= DateFunctions::getMonthShortName(date('m', $company->dt_add)) ?> <?= date('H:i', $company->dt_add) ?></span>
    <h2><?= $company->name ?></h2>
    <a href="" class="view-img"><img src="<?= $company->photo ?>" alt=""></a>
    <p><b>Тел.:</b> <?= $company->phone ?></p>
    <p><b>Адрес:</b> <?= $company->address ?></p>
    <p><b>Email:</b> <?= $company->email ?></p>
    <?= $company->descr ?>
</div>
<div class="post-nav">
    <span><a href=""><i class="fa fa-eye" aria-hidden="true"></i> <?= $company->views ?></a></span>
    <?php if (!empty($company->tags)): ?>
        <span>Теги: <?= $company->tags ?></span>
    <?php endif ?>
    <span>Поделись <a href="" class="soc-icon"><img src="/theme/portal-donbassa/img/twi.png" alt=""></a><a href=""
                                                                                                           class="soc-icon"><img
                src="/theme/portal-donbassa/img/fb.png" alt=""></a></span>
</div>