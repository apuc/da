<?php
header('Content-type: image/jpg');
$old_path = __DIR__ . $_SERVER['IMG_URI'];
$width = isset($_GET['width']) ? $_GET['width'] : 1000;
$pathinfo = pathinfo(substr($_SERVER['IMG_URI'], 13));
$cache_path = __DIR__ . '/cache-img' . $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $width;
$cache_path_with_file = __DIR__ . '/cache-img' . $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $width . DIRECTORY_SEPARATOR . $pathinfo['basename'];
if (file_exists($cache_path_with_file)) {
    $img = file_get_contents($cache_path_with_file);
} else {
    if (file_exists($old_path)) {
        if (file_exists($cache_path)) {
            if (!file_exists($cache_path_with_file)) {
                $image = new Imagick($old_path);
                $image->thumbnailImage($width, 0);
                $image->setImageCompressionQuality(85);
                file_put_contents($cache_path_with_file, $image);
                $img = $image;
            }
        } else {
            mkdir($cache_path, 0777, true);
            $image = new Imagick($old_path);
            $image->thumbnailImage($width, 0);
            $image->setImageCompressionQuality(85);
            file_put_contents($cache_path_with_file, $image);
            $img = $image;
        }
    } else {
        $img = file_get_contents(__DIR__ . '/theme/portal-donbassa/img/no-image.png');
    }
}
echo $img;
