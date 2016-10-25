<?php


namespace backend\modules\posts_digest\models;


use yii\db\ActiveRecord;

class PostsDigest extends \common\models\db\PostsDigest {
    public function behaviors() {
        return [
            'slug'      => [
                'class'         => 'common\behaviors\Slug',
                'in_attribute'  => 'title',
                'out_attribute' => 'slug',
                'translit'      => true
            ],
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => [ 'dt_add', 'dt_update' ],
                    ActiveRecord::EVENT_BEFORE_UPDATE => [ 'dt_update' ],
                ],
            ],
        ];
    }
}