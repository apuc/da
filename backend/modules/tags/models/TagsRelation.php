<?php
/**
 * Created by PhpStorm.
 * User: perff
 * Date: 08.08.2017
 * Time: 16:22
 */

namespace backend\modules\tags\models;


class TagsRelation extends \common\models\db\TagsRelation
{
    public function saveTagsRel($tag_id, $post_id, $post_type)
    {
        $this->post_id = $post_id;
        $this->tag_id = $tag_id;
        $this->type = $post_type;
        $this->save();
    }

    public function getTagname()
    {
        return $this->hasOne(Tags::className(), ['id' => 'id']);
    }
}