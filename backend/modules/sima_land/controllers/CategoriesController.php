<?php


namespace backend\modules\sima_land\controllers;

use Exception;
use Yii;
use yii\web\Controller;
use backend\modules\sima_land\models\SearchCategories;
use Classes\Wrapper\Wrapper;
use Classes\Wrapper\IUrls;

class CategoriesController extends Controller
{
    public $count = 1;

    /**
     * Lists all categories models.
     * @return mixed
     * @throws Exception
     */
    public function actionIndex()
    {
        $resultData = array();

        foreach (Wrapper::runFor(IUrls::Category)
                     ->getPage(1)
                     ->getItemFromJson() as $item) {
            array_push($resultData,
                array(
                    "id" => $item->id,
                    "sid" => $item->sid,
                    "name" => $item->name,
                    "path" => $item->path,
                    "level" => $item->level,
                    "photo" => $item->photo,
                    "icon" => $item->icon,
                    "priority" => $item->priority,
                    "is_adult" => $item->is_adult,
                    "has_design" => $item->has_design,
                    "is_for_mobile_app" => $item->is_for_mobile_app,
                    "full_slug" => $item->full_slug));
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
                    'full_slug',
                    'level',
                    'photo',
                    'icon',
                    'priority',
                    'has_design',
                    'is_for_mobile_app',
                    'is_adult',
                    'path'],
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
