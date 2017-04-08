<?php
namespace backend\modules\posts_consulting\models;
use yii\db\ActiveRecord;

/**
 * Created by PhpStorm.
 * User: warya
 * Date: 24.10.2016
 * Time: 13:39
 */
class PostsConsulting extends \common\models\db\PostsConsulting {
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