<?php
$this->title = $meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );

$this->registerJsFile('/js/jquery-ui-1.12.1/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
