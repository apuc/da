<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 31.05.2018
 * Time: 10:55
 */

namespace common\classes;

/**
 * Class Folder
 * @package common\classes
 */
class Folder
{
    public $path;
    public $mode;
    public $_file;
    public $_fileImg;
    public $error;
    public $type;

    public function __construct($path, $mode)
    {
        $this->_fileImg = new \Imagick();
        $this->path = $path;
        $this->mode = $mode;
    }

    public function create()
    {
        if (!self::createPath($this->path, $this->mode, true)) {
            $this->error[] = 'Не удалось создать каталог ' . $this->path;
        }
        return $this;
    }

    public function file($file)
    {
        if (!empty($file)) {
            $this->_file = $file;
            if (getimagesize($this->_file)) {
                $this->_fileImg->readImage($this->_file);
                $this->type = 'img';
            }
        }
        return $this;
    }

    public function save($name)
    {
        if ($this->type !== 'img') {
            if (!copy($this->_file, $this->path . $name)) {
                $this->error[] = 'Не удалось скопировать ' . $this->_file;
                return false;
            }
        } else {
            $this->_fileImg->writeImage($this->path . $name);
        }
        return true;
    }

    public function thumbnail($name, $data, $path = null)
    {
        if ($this->type !== 'img') {
            return $this;
        }
        $path = $path === null ? $this->path : $path;
        $thumb = new \Imagick($this->_file);
        $thumb->cropThumbnailImage($data['w'], $data['h']);
        //$thumb->resizeImage($data['w'],$data['h'],$filter,1);
        $thumb->writeImage($path . $name);
        $thumb->destroy();
        return $this;
    }

    public function watermark($watermark, $x, $y)
    {
        if ($this->type !== 'img') {
            return $this;
        }
        if (is_string($watermark)) {
            $watermark = new \Imagick($watermark);
        }
        $this->_fileImg->compositeImage($watermark, \Imagick::COMPOSITE_ATOP, $x, $y);
        return $this;
    }

    public function crop($w, $h, $x, $y)
    {
        $this->_fileImg->cropImage($w, $h, $x, $y);
        return $this;
    }

    /**
     * @param string $path
     * @param int $mode
     * @param bool $recursive
     * @return bool
     */
    public static function createPath($path, $mode = 0775, $recursive = true)
    {
        if (!file_exists($path)) {
            return mkdir($path, $mode, $recursive);
        }
        return true;
    }

}