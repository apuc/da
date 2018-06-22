<?php

use common\models\db\News;
use yii\helpers\Url;

/**
 * @var News $model
 * @var int $countComments
 */
?>
<!doctype html>
<html amp lang="ru">
<head>
    <meta charset="utf-8">
    <title><?=($model->meta_title) ? $model->meta_title : $model->title?></title>
    <link rel="canonical" href="<?=Url::to(['/news/default/view', 'slug' => $model->slug])?>">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-custom>
    </style>
    <script type="application/ld+json">
{
"@context": "http://schema.org",
"@type": "NewsArticle",
"headline": "Open-source framework for publishing content",
"datePublished": "2015-10-07T12:02:41Z",
"image": [
"logo.jpg"
]
}

</script>
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
</head>
<body>
    <h1><?= $model->title; ?></h1>
    <div>
        <span><?= $countComments . ' ' . \common\classes\WordFunctions::getNumEnding($countComments,
                [
                    'комментарий',
                    'комментария',
                    'комментариев',
                ]); ?></span>
        <span><?= $model->views; ?> просмотров</span>
        <span><?= \common\classes\WordFunctions::FullEventDate($model->dt_public) ?></span>
    </div>

    <?php if (stristr($model->photo, 'http')):
        $img = $model->photo;
    else:
        $img = \common\models\UploadPhoto::getImageOrNoImage($model->photo);
    endif;
    $alt = !empty($model->alt) ? $model->alt : $model->title;
    ?>
        <amp-img height="200px" width="500px" src="<?= $img; ?>" alt="<?= $alt; ?>" layout="responsive"></amp-img>
    <p><?= nl2br(strip_tags($model->content)) ?></p>
</body>
</html>