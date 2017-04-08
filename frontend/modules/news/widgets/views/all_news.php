<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 17:00
 * @var $news \common\models\db\News
 * @var $pages \yii\data\Pagination
 * @var $dataProvider \yii\data\SqlDataProvider
 */
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>

<div class="all-news-to-day">
    <h4>Все новости</h4>

    <ul class="news column-list-js">
        <?php /*foreach ($news as $new): */ ?><!--
            <li>
                <a href="<? /*= \yii\helpers\Url::to(['/news/default/view', 'slug' => $new->slug]) */ ?>">
                    <span class="time"><? /*= date('d.m H:i', $new->dt_public) */ ?></span>
                    <? /*= $new->title */ ?>
                    <span class="views">
                                    <span class="view-icon"></span>
                        <? /*= $new->views */ ?>
                                </span>
                </a>
            </li>
        --><?php /*endforeach; */ ?>
        <?php Pjax::begin(); ?>
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_list',
            'pager' => [
                'options' => [
                    'class' => 'paginator',
                    'tag' => 'div',
                ],
                'nextPageCssClass' => 'next',
                'nextPageLabel' => '<img src="/theme/portal-donbassa/img/paginator-right.png" alt="">',
                'prevPageCssClass' => 'prev',
                'prevPageLabel' => '<img src="/theme/portal-donbassa/img/paginator-left.png" alt="">',
            ]
        ]) ?>
        <?php Pjax::end(); ?>
    </ul>
    <!--<div class="paginator">
        <?php /*echo LinkPager::widget([
            'pagination' => $pages,
            'options' => [
                'class' => 'paginator'
            ],
            'nextPageCssClass' => 'next',
            'nextPageLabel' => '<img src="/theme/portal-donbassa/img/paginator-right.png" alt="">',
            'prevPageCssClass' => 'prev',
            'prevPageLabel' => '<img src="/theme/portal-donbassa/img/paginator-left.png" alt="">',
            'linkOptions' => [
                'class' => 'allNewsPageLink'
            ]
        ]); */?>
    </div>-->
    <!--<div class="paginator">
        <ul>
            <li><a href="#" class="prev"><img src="/theme/portal-donbassa/img/paginator-left.png" alt=""></a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a href="#">7</a></li>
            <li><a href="#">8</a></li>
            <li><a href="#">9</a></li>
            <li><a href="#">10</a></li>
            <li><a href="#" class="next"><img src="/theme/portal-donbassa/img/paginator-right.png" alt=""></a></li>
        </ul>
    </div>-->
</div>
