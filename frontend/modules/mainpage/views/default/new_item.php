<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 07.09.2016
 * Time: 17:12
 * @var $news \common\models\db\News
 */
use yii\helpers\Url;

?>
<div class="content__main_post_pic">
    <a href="#" class="date-post">
        <span class="date"><?= date('Y-m-d H:i', $news->dt_add) ?></span>
        <span class="note"></span>
    </a>
    <img src="<?= $news->photo ?>" alt="">
</div>
<div class="content__main_post_text">
    <h2><?= $news->title ?></h2>
    <p><?= \common\classes\WordFunctions::crop_str_word($news->content);  ?></p>
</div>
<div class="content__main_post_navigation">
    <a href="" class="views"><span class="view-icon"></span><?= $news->views ?> просмотров  </a>
    <!--<a href="" class="comments"><span class="comments-icon"></span> 21 комментарий</a>-->
    <a href="<?= Url::to(['/news/default/view', 'slug' => $news->slug]) ?>" class="next-read">Читать дальше<span class="arrow-next"></span></a>
</div>
