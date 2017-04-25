<?php
?>
<aside id="aside">
    <div class="consult-company">
        <h3>Консультирующие компании</h3>
        <ul>
            <?php foreach ($consulting as $item): ?>
                <li>
                    <div class="title"><a href="<?= \yii\helpers\Url::to(['/consulting/consulting/view', 'slug' => $item->slug]); ?>"><?= $item->title;?></a></div>
                    <div class="description"><?= strip_tags($item->descr);?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>
