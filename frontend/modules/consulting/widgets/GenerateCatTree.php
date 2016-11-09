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
use yii\helpers\Url;

class GenerateCatTree extends Widget {
    public $categories;
    public $id_attr;
    public $url;
    public $active_id;
    public $cat;

    public function run() {
        if (!$this->active_id){
            $this->active_id = 0;
        }
        echo $this->get_tree( $this->categories );
    }

    public function get_tree( $tree, $parent_id = 0 ) {
        $html = '';
        foreach ( $tree as $row ) {
            if ( $row['parent_id'] == $parent_id ) {
                if ($row['id']== $this->active_id){
                   $active = 'active';
                  //  Debug::prn($row['id']);
                } else{
                    $active = '';
                    //Debug::prn($this->active_id);
                }
              // $url = Url::to([$this->url . $row['slug']]);
                $url = Url::to([$this->url ,'slugcategory'=> $row['slug']]);
                $html .= '<li><a class="parent '.$active.'" '.$this->id_attr. '="' . $row['id'] . '" href="'.$url.'">';
                $html .= '' . $row['title'];
                $html .= '' . ' [' . $this->getCountCat( $row['id'], $tree, $row['memberCount'] ) . ' вопросов] </a>';
                $html .= '' . $this->get_tree( $tree, $row['id'] );
                $html .= '</li>';
            }
        }

        return $html ? '<ul class="consult-item-mnu-menu inserted">' . $html . '</ul>' . "\n" : '';
    }

    public function getCountCat( $id, $tree, $memCount = 0 ) {
        foreach ( $tree as $row ) {
            if ( $row['parent_id'] == $id ) {
                $memCount = $row['memberCount'] + $this->getCountCat( $row['id'], $tree, $memCount );
            }
        }

        return $memCount;
    }
}