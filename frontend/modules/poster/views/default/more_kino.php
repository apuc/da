<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 16:22
 * @var $posters \common\models\db\Poster
 */
use common\classes\WordFunctions;
use yii\helpers\Url;
?>
<?php foreach ($posters as $poster): ?>
    <a href="<?= Url::to(['/poster/default/view', 'slug'=>$poster->slug]) ?>" class="item">
        <img src="<?= $poster->photo ?>" alt="">
        <div class="item-content">
            <span class="type"><?= isset($poster->categories[0]) ? $poster->categories[0]->title : false ?></span>
            <span class="name-item"><?= $poster->title ?></span>
            <span class="time">
                        <?= WordFunctions::dateWithMonts($poster->dt_event) ?>, <?= date('H:i',$poster->dt_event) ?>
                    </span>
        </div>
    </a>
<?php endforeach; ?>
