<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 06.05.2017
 * Time: 11:43
 */

namespace frontend\widgets;

use yii\base\Widget;

class Comments extends Widget
{

    public $pageTitle = 'Комментарии';
    public $postType = null;
    public $postId = null;

    public function run()
    {



        return $this->render('comments');
    }

}