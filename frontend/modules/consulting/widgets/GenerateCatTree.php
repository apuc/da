<?php


namespace frontend\modules\consulting\widgets;


use backend\modules\category_company\models\CategoryCompany;
use common\classes\Debug;
use common\models\db\CategoryNews;
use common\models\db\CategoryPoster;
use common\models\db\Poster;
use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class GenerateCatTree extends Widget {
    public $categories_faq;

    public function run() {
        echo $this->get_tree($this->categories_faq);
    }

    public function get_tree($tree, $parent_id=0) {
        $html = '';
        foreach ($tree as $row) {
            if ($row['parent_id'] == $parent_id) {
                $html .= '<li><a class="parent" href="#">';
                $html .= '' . $row['title'];
               // $html .='' . ' ['.$row['memberCount'].' вопросов] </a>';
                $html .= '' . $this->get_tree($tree, $row['id']);
                $html .= '</li>' ;
            }
        }
        return $html ? '<ul class="consult-item-mnu-menu inserted">' . $html . '</ul>' . "\n" : '';
    }
}