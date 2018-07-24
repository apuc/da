<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.10.2016
 * Time: 11:31
 * @var $category \common\models\db\CategoryPoster
 * @var $dataProvider \yii\data\SqlDataProvider
 */
use yii\helpers\Url;
$this->title = $catName . ' на da-info.pro';
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );
?>
<div class="posters">
    <div class="shape">
        <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
    </div>
    <div class="posters-categories">
        <a class="archive-posters" href="<?= Url::to(['/poster/default/archive_category']);?>">Архив мероприятий</a>
        <ul class="posters-categories-list">
            <?php foreach ($category as $item): ?>
                <li><a href="<?= Url::to([(Yii::$app->controller->action->id == 'category' || Yii::$app->controller->action->id == 'single_category')?'/poster/default/single_category': '/poster/default/single_archive_category', 'slug'=>$item->slug]) ?>"><?= $item->title ?>
                        <!--<span>90</span>-->
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="clearfix"></div>
        <div class="shape">
            <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
        </div>
        <!--<ul class="posters-month">
            <li class="active"><a href="#">Январь<span>222</span></a></li>
            <li><a href="#">Февраль<span>80</span></a></li>
            <li><a href="#">Март<span>79</span></a></li>
            <li><a href="#">Апрель<span>79</span></a></li>
            <li><a href="#">Май<span>78</span></a></li>
            <li><a href="#">Июнь<span>77</span></a></li>
            <li><a href="#">Июль<span>76</span></a></li>
            <li><a href="#">Август<span>75</span></a></li>
            <li><a href="#">Сентябрь<span>9</span></a></li>
            <li><a href="#">Октябрь<span>6</span></a></li>
            <li><a href="#">Ноябрь<span>1</span></a></li>
            <li><a href="#">Декабрь<span>5</span></a></li>
        </ul>
        <a class="categories-clear-option" href="#">Очистить параметры</a>-->
    </div>
    <div class="posters-posts content__main afisha__right">
        <div class="afisha__right">
            <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => (Yii::$app->controller->action->id == 'category' || Yii::$app->controller->action->id == 'archive_category') ? '_poster_item' : '_s_poster_item',
                'layout' => "{items}\n{pager}",
            ]); ?>
        </div>
    </div>
    <div class="clearfix"></div>
<!--    <div class="banner-bottom">-->
<!--        <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">-->
<!--    </div>-->
</div>