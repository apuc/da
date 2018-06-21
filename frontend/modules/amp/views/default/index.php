<?php

use common\models\db\News;
use yii\helpers\Url;

/**
 * @var News[] $news
 */
?>
<!doctype html>
<html amp lang="ru">
<head>
    <meta charset="utf-8">
    <title>DA news</title>
    <link rel="canonical" href="https://da-info.pro/all-new">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-custom>
body {
background-color: white;
}
amp-img {
background-color: gray;
}
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
<?php foreach ($news as $new): ?>
    <h1><?= $new->title ?></h1>
<a href="<?= Url::to(['/news/default/view', 'slug' => $new->slug]); ?>">
    <amp-img src="<?= $new->photo ?>" alt="$new->title" height="500" width="800"></amp-img>
</a>
    <p><?= strip_tags($new->content) ?></p>

<?php endforeach ?>
</body>
</html>