<li>
    <a href="<?= \yii\helpers\Url::to(['/news/default/view', 'slug' => $model['slug']]) ?>">
        <span class="time">
            <?= date('d.m', $model['dt_public']) ?><br>
            <span><?= date('H:i', $model['dt_public']) ?></span>
        </span>
        <?= $model['title'] ?>
        <span class="views">
            <span class="view-icon"></span>
            <?= $model['views'] ?>
        </span>
    </a>
</li>