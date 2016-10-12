<li>
    <a href="<?= \yii\helpers\Url::to(['/news/default/view', 'slug' => $model['slug']]) ?>">
        <span class="time"><?= date('d.m H:i', $model['dt_public']) ?></span>
        <?= $model['title'] ?>
        <span class="views">
                                    <span class="view-icon"></span>
            <?= $model['views'] ?>
                                </span>
    </a>
</li>