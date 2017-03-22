<li>
            <span class="time">
            <?= date('d.m', $model['dt_public']) ?><br>
            <span><?= date('H:i', $model['dt_public']) ?></span>
        </span>
    <a href="<?= \yii\helpers\Url::to(['/news/default/view', 'slug' => $model['slug']]) ?>">

        <?= $model['title'] ?>
        <span class="views">
            <i class="views-ico fa fa-eye"></i>
<!--            <span class="view-icon"></span>-->
            <?= $model['views'] ?>
        </span>
    </a>
</li>