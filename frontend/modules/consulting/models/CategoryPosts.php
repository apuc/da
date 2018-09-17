<?php
namespace frontend\modules\consulting\models;

use common\classes\Debug;
use common\models\db\CategoryPostsConsulting;

class CategoryPosts extends CategoryPostsConsulting {

    public static function getChildCategoriesById( $id ) {

        return self::getChildCategoriesById_Function( $id, CategoryPostsConsulting::find()->all() );
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