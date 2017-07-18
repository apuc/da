<?php
$this->title = $meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );

$this->registerJsFile('/theme/portal-donbassa/js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
