<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 14.06.2017
 * Time: 17:21
 */
use common\classes\WordFunctions;
use frontend\modules\search\models\Search;

/*\common\classes\Debug::prn(\frontend\modules\search\models\Search::getTypeLabel($model['material_type']));*/
?>


<!--<h2><?php /*echo \yii\helpers\Html::a(\yii\helpers\Html::encode($model->title), $model->material->url)*/?></h2>-->
<a href="<?= $model['url']; ?>" class="search-content__item">

    <p class="search-content__item--title"><?= Search::getTypeLabel($model['material_type']); ?></p>

    <div class="search-content__item--img">
        <img src="<?= $model['photo']?>" alt="<?= $model['title']; ?>">
    </div>

    <div class="search-content__item--content">

        <h3><?= $model['title']; ?></h3>
        <span><?= WordFunctions::dateWithMonts($model['dt_update']); ?></span>
        <p>… крымчане наблюдают уже в российском Крыму. Крым превращается в непонятно что и …
            референдума.. В последнее время, в Крыму появилось очень много украинских номеров …
            прекрасно. Фото сделаны напротив Совмина Крыма. Крымчане сейчас не могут ездить …</p>

    </div>

</a>