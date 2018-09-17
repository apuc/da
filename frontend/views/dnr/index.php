<?php
$this->title = $meta['dnr_title_page']->value;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta['dnr_desc_page']->value,
]);
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('/js/jquery-ui-1.12.1/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);






