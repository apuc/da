<?php
/**
 * Created by PhpStorm.
 * User: waryataw
 * Date: 19.10.2016
 * Time: 13:44
 */

namespace frontend\widgets;


use backend\modules\category_company\models\CategoryCompany;
use common\classes\Debug;
use common\models\db\CategoryNews;
use common\models\db\CategoryPoster;
use common\models\db\Poster;
use Yii;
use yii\base\Widget;

class GenerateTitleMenu extends Widget
{
    public function run() {
        
        return $this->render('title_mnu');
        
    }
}