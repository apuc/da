<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tbl_view_search".
 *
 * @property string $id
 * @property string $title
 * @property string $photo
 * @property string $descr
 * @property integer $dt_update
 * @property string $url
 * @property string $material_type
 * @property string $slug
 */
class TblViewSearch extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_view_search';
    }

}
