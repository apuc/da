<?php
/**
 * Created by PhpStorm.
 * User: perff
 * Date: 08.08.2017
 * Time: 16:22
 */

namespace backend\modules\tags\models;




use frontend\modules\company\models\Company;
use frontend\modules\news\models\News;

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
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }

    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'post_id'])->where(['status' => 0]);
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'post_id'])->where(['status' => 0]);
    }
}