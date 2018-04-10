<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 10.04.2018
 * Time: 14:57
 * @var $item \common\models\db\News
 */
?>
<![CDATA[
<header>
    <h1><?= $item->title ?></h1>
</header>
<p>
    <?= nl2br($item->content) ?>
</p>

<img src="<?= $item->photo ?>" />
]]>