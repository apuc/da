<?php
namespace frontend\modules\consulting\models;

use common\classes\Debug;

class CategoryFaq extends \common\models\db\CategoryFaq {

    public static function getChildCategoriesById( $id ) {

        return self::getChildCategoriesById_Function( $id, \common\models\db\CategoryFaq::find()->all() );
    }

    protected static function getChildCategoriesById_Function( $id, $tree, &$arrCat = null ) {
        if ( $arrCat == null ) {
            //current id we need to
            $arrCat[] = $id;
        }

        foreach ( $tree as $row ) {
            if ( $row['parent_id'] == $id ) {
                $arrCat[] = $row['id'];
                 self::getChildCategoriesById_Function( $row['id'], $tree, $arrCat );
            }
        }

        return $arrCat;
    }

}