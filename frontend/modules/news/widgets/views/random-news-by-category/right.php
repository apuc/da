<div class="more-news">

    <h3>Читайте по теме</h3>

    <ul>
        <?php foreach ($news as $new): ?>
            <li>
                <span><?= date('d',
                        $new->dt_public) . ' ' .
                    \common\classes\WordFunctions::getRuMonth()[date('m', $new->dt_public)] . ' ' .
                    date('Y', $new->dt_public) . ', в ' .
                    date('H:i', $new->dt_public); ?></span>
                <a href="<?= \yii\helpers\Url::to([
                    "/news/default/view",
                    "slug" => $new->slug,
                ]); ?>" title="<?= $new->title;?>"><?= $new->title; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>