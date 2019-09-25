<?php

namespace backend\modules\sima_land\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class SearchCategories extends ActiveRecord
{
    public $path;
    public $level;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'path' ] , 'safe' ] ,
            [ [ 'level' ] , 'safe' ] ,
        ];
    }

    public function search($queryParams)
    {
        return $queryParams;
    }
}
