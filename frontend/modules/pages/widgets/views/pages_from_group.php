<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 06.05.2017
 * Time: 11:28
 * @var $pages \common\models\db\Pages
 */
use common\classes\WordFunctions;
use yii\helpers\Url;

?>
<div class="more-news">

    <h3>Читайте по теме</h3>

    <ul>
        <?php foreach ($pages as $page): ?>
            <li>
                <span><?= date('d',
                        $page->dt_add) . ' ' .
                    WordFunctions::getRuMonth()[date('m', $page->dt_add)] . ' ' .
                    date('Y', $page->dt_add) . ', в ' .
                    date('H:i', $page->dt_add); ?></span>
                <a href="<?= Url::to([
                    "/pages/default/view",
                    "slug" => $page->slug,
                ]); ?>"><?= $page->title; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
