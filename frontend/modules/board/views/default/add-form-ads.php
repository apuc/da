<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 04.08.2017
 * Time: 13:08
 */?>

<form action="" method="post">
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken?>" id="">
    <input type="text" name="Ads[title]" id="">
    <input type="hidden" name="Ads[user_id]" value="1" id="">

    <input type="text" name="Ads[category_id]" id="">
    <input type="text" name="Ads[content]" id="">
    <input type="text" name="Ads[city_id]" id="">
    <input type="text" name="Ads[private_business]" id="">
    <input type="text" name="Ads[phone]" id="">
    <input type="submit" name="" value="Add" id="">
</form>
