<?php
/**
 * @var $ads
 * @var $category
 */


?>

<?php
    foreach ($ads as $item):
        //\common\classes\Debug::prn($item);
?>
        <?= \yii\helpers\Html::a($item->title, \yii\helpers\Url::to(['view', 'slug' => $item->slug, 'id' => $item->id])); ?>

    <?= $item->content; ?>
    <?= $item->price; ?>
        <img src="<?= $item->adsImgs[0]->img_thumb?>" alt="">
<?php
    endforeach;