<?php
$this->title = $meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/jquery-ui-1.12.1/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
