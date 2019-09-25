<?php


namespace backend\modules\sima_land\models;

use backend\modules\sima_land\controllers\DefaultController;
use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use yii\data\ArrayDataProvider;
use yii\db\ActiveRecord;

class SearchGoods extends ActiveRecord
{
    public $category_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'category_id' ] , 'safe' ] ,
        ];
    }

    public function search($queryParams)
    {
        $resultData = Wrapper::objectToArray( Wrapper::runFor(IUrls::Goods)
            ->query($queryParams)->getItemFromJson());
        $dataProvider = new ArrayDataProvider([
            'key' => 'id' ,
            'allModels' => $resultData ,
            'pagination' => [ 'pageSize' => 50] ,
            'sort' => [
                'attributes' => array_keys($resultData[0])
            ] ,
        ]);
        return $dataProvider;
    }
}
