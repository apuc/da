<?php

namespace backend\modules\news\models;

use yii\db\ActiveRecord;

class ForcedView extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forced_views';
    }

    public $newsId;
    public $views;

    public static function getViews($id): int
    {
        $views = static::findOne(['news_id' => $id]);

        return $views->views ?? 0;
    }

    function init()
    {
        parent::init();
    }
}