<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.05.2017
 * Time: 16:51
 */

namespace backend\modules\vk\models;

class VkStream extends \common\models\db\VkStream
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
        ];
    }

}