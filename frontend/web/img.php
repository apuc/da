<?php
$string = $_SERVER['IMG_URI'];
$width = $_GET['width'];
$oldFile = __DIR__ . $string;
if (!file_exists($oldFile)) {
    $newFile = __DIR__ . '/theme/portal-donbassa/img/no-image.png';
} elseif (!empty($width)) {
    $newDir = pathinfo(substr($string, 13))['dirname'];
    if (!file_exists($pathCache = __DIR__ . '/cache-img/')) mkdir($pathCache);
    $pathWidth = $pathCache . $newDir . '/' . $width . '/';
    $newFile = $pathWidth . pathinfo($string)['basename'];
    if (!file_exists($dir = $pathCache . $newDir)) mkdir($dir);
    if (!file_exists($pathWidth)) mkdir($pathWidth);
    if (!file_exists($newFile)) {
        $image = new Imagick($oldFile);
        $image->thumbnailImage($width, 0);
        file_put_contents($newFile, $image);
    }
} else $newFile = __DIR__ . $string;
header('Content-type: image/jpeg');
echo file_get_contents($newFile);
