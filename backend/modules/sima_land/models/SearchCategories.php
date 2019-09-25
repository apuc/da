<?php

namespace backend\modules\sima_land\models;

use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

class SearchCategories extends ActiveRecord
{
    public $value;
    public $full_slug;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'full_slug' ] , 'safe' ] ,
            [ [ 'value' ] , 'safe' ] ,
        ];
    }

    public function search($queryParams)
    {
        $resultData = Wrapper::objectToArray( Wrapper::runFor(IUrls::Category)
        ->query($queryParams)->getItemFromJson());

        $dataProvider = new ArrayDataProvider([
            'key' => 'id' ,
            'allModels' => $resultData ,
            'pagination' => [ 'pageSize' => $this->pageSize , 'totalCount' => $this->totalPages ] ,
            'sort' => [
                'attributes' => array_keys($resultData[0])
            ] ,
        ]);

        return $dataProvider;
    }
}
