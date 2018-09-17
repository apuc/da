<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\widgets;


use common\classes\Debug;
use yii\base\Widget;

class _Comments extends Widget {
    public $post_id;
    public $post_type;

    public function run() {
        $limit          = 5;
        $count_comments = count( \common\models\db\Comments::find()
                                         ->where( [ 'post_type' => $this->post_type, 'post_id' => $this->post_id ] )
                                         ->all() );

        $comments = \common\models\db\Comments::find()
                            ->where( [
                                'post_type' => $this->post_type,
                                'post_id'   => $this->post_id,
                            ] )
                            ->orderBy( 'dt_add DESC' )
                            ->limit( $limit )
                            ->all();

        return $this->render( 'comments', [
            'count_comments' => $count_comments,
            'comments'       => $comments,
            'post_type'       => $this->post_type,
            'post_id'       => $this->post_id,
            'limit'          => $limit,
        ] );
    }


}