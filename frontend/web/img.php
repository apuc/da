<?php
header('Content-type: image/jpg');
$default_img = __DIR__ . '/theme/portal-donbassa/img/no-image.png';
$img_uri = $_SERVER['IMG_URI'];
$old_path = __DIR__ . $img_uri;
$width = isset($_GET['width']) ? $_GET['width'] : 1000;
$pathinfo = pathinfo(substr($img_uri, 13));
$cache_path = __DIR__ . '/cache-img' . $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $width;
$cache_path_with_file = __DIR__ . '/cache-img' . $pathinfo['dirname'] . DIRECTORY_SEPARATOR . $width . DIRECTORY_SEPARATOR . $pathinfo['basename'];
if (file_exists($cache_path_with_file)) {
    echo file_get_contents($cache_path_with_file);
    die();
} else {
    if (file_exists($old_path)) {
        if (file_exists($cache_path)) {
            if (!file_exists($cache_path_with_file)) {
                $image = new Imagick($old_path);
                $image->thumbnailImage($width, 0);
                $image->setImageCompressionQuality(85);
                file_put_contents($cache_path_with_file, $image);
                echo $image;
                die();
            }
        } else {
            mkdir($cache_path, 0777, true);
            $image = new Imagick($old_path);
            $image->thumbnailImage($width, 0);
            $image->setImageCompressionQuality(85);
            file_put_contents($cache_path_with_file, $image);
            echo $image;
            die();
        }
    } else {
        echo file_get_contents($default_img);
        die();
    }
}
