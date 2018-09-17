<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 11.07.2016
 * Time: 14:25
 */

namespace common\behaviors;


use common\classes\Debug;
use common\models\db\GeobaseCity;
use common\models\db\GeobaseRegion;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class SaveRegionId extends Behavior
{
    public $in_attribute = 'city_id';
    public $out_attribute = 'region_id';

    public function events()
    {

        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'getRegion'
        ];
    }

    public function getRegion( $event )
    {
        if (!empty( $this->owner->{$this->in_attribute} ) ) {
            $this->owner->{$this->out_attribute} =  GeobaseCity::find()->where(['id' => $this->owner->{$this->in_attribute}])->one()->region_id;
         }
    }
}