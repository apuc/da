<?php if(!empty($popularPosters)): ?>

<div class="what-to-see">
    <h3>Популярные спектакли сезона</h3>
    <a href="#" class="view-more">посмотреть больше</a>
    <div class="afisha-events__wrap">
        <?php foreach ($popularPosters as $poster): ?>
            <a href="<?= \yii\helpers\Url::to(['/poster/default/view','slug'=>$poster->slug]);?>" class="item">
                <img src="<?= $poster->photo;?>" alt="">
                <div class="item-content">
                    <span class="type"><?= $poster->categories[0]->title;?></span>
                    <span class="name-item"><?= $poster->title;?></span>
                    <span class="time">"<?= \common\classes\WordFunctions::FullEventDate($poster->dt_event);?>"</span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <?php if($popularPostersCount > 4): ?>
        <a href="" class="load-more load-more-popular-poster-w"
           csrf-token="<?= Yii::$app->request->csrfToken ?>"
           data-page="1"
           data-limit="4"
           data-count-post="<?= $popularPostersCount; ?>"
        >
            загрузить БОЛЬШЕ
        </a>
    <?php endif; ?>
</div>
<?php
endif;