<?php foreach ($posters as $poster): ?>
    <a href="<?= \yii\helpers\Url::to(['/poster/default/view','slug'=>$poster->slug]);?>" class="item">
        <img src="<?= $poster->photo;?>" alt="">
        <div class="item-content">
            <span class="type"><?= $poster->categories[0]->title;?></span>
            <span class="name-item"><?= $poster->title;?></span>
            <span class="time">"<?= \common\classes\WordFunctions::FullEventDate($poster->dt_event);?>"</span>
        </div>
    </a>
<?php endforeach; ?>