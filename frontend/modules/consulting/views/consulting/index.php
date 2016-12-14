   <?php
   $this->title = $meta_title;
   $this->registerMetaTag( [
       'name'    => 'description',
       'content' => $meta_descr,
   ] );
   ; ?>
    <div class="consulting">
            <div class="consulting-items">
                <?php foreach ($consulting as $item) :?>
                    <div class="consulting-item">
<!--                        <img class="consulting-icon" src="--><?//=$item->icon ; ?><!--" alt="">-->

                        <i class="fa <?= $item->icon; ?>"></i>

                        <h4><?= $item->title; ?></h4>
                        <span class="line"></span>
                        <a href="<?=\yii\helpers\Url::to(["/consulting/consulting/view",'slug'=>$item->slug]) ; ?>" class="link">Подробнее</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

