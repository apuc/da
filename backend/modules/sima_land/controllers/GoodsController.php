<?php


namespace backend\modules\sima_land\controllers;


use Exception;
use Yii;
use yii\web\Controller;
use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;

class GoodsController extends Controller
{
    /**
     * Lists all goods models.
     * @return mixed
     * @throws Exception
     */
    public function actionIndex()
    {
        $resultData = array();

        foreach (Wrapper::runFor(IUrls::Goods)
                     ->getPage(1)
                     ->getItemFromJson() as $item) {
            array_push($resultData,
                array(
                    "id" => $item->id,
                    "sid" => $item->sid,
                    "name" => $item->name,
                    "uid" => $item->uid,
                    "price" => $item->price,
                    "price_max" => $item->price_max,
                    "price_per_square_meter" => $item->price_per_square_meter,
                    "price_per_linear_meter" => $item->price_per_linear_meter,
                    "currency" => $item->currency,
                    "minimum_order_quantity" => $item->minimum_order_quantity,
                    "in_box" => $item->in_box,
                    "max_qty" => $item->max_qty,
                    "min_qty" => $item->min_qty,
                    "updated_at" => $item->updated_at,
                    "trademark_id" => $item->trademark_id,
                    "country_id" => $item->country_id,
                    "created_at" => $item->created_at,
                    "slug" => $item->slug));
        }

        $searchModel = ['id' => null, 'name' => null];

        $dataProvider = new \yii\data\ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'sort' => [
                'attributes' => [
                    'id',
                    'sid',
                    'name',
                    'slug',
                    'uid',
                    'price',
                    'price_per_square_meter',
                    'price_per_linear_meter',
                    'price_max',
                    'currency',
                    'minimum_order_quantity',
                    'in_box',
                    'max_qty',
                    'min_qty',
                    'trademark_id',
                    'country_id',
                    'created_at',
                    'updated_at'],
            ],
        ]);

        return $this->render('index', [
            'title' => "1",
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
