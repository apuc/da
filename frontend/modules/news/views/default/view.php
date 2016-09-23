<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 16:15
 * @var $news \common\models\db\News
 */

use common\classes\DateFunctions;

$this->title = $news->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $news->meta_descr,
]);
?>
<div class="shape">
    <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
</div>
<div class="news__post">
    <span class="date-news__post"><?= date('d', $news->dt_add) ?> <?= DateFunctions::getMonthShortName(date('m', $news->dt_add)) ?> <?= date('H:i', $news->dt_add) ?></span>
    <h2><?= $news->title ?></h2>
    <a href="" class="view-img"><img src="<?= $news->photo ?>" alt=""></a>
    <?= $news->content ?>
</div>
<div class="post-nav">
    <span><a href=""><i class="fa fa-eye" aria-hidden="true"></i> <?= $news->views ?></a></span>
    <?php if (!empty($news->tags)): ?>
        <span>Теги: <?= $news->tags ?></span>
    <?php endif ?>
    <span>Поделись <a href="" class="soc-icon"><img src="/theme/portal-donbassa/img/twi.png" alt=""></a><a href=""
                                                                                                           class="soc-icon"><img
                src="/theme/portal-donbassa/img/fb.png" alt=""></a></span>
</div>
