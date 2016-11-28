<?php

namespace frontend\modules\poster\controllers;

use backend\modules\poster\controllers\PosterController;
use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\Poster;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `poster` module
 */
class DefaultController extends Controller
{
    public $layout = 'portal_page';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($slug){
        $poster = Poster::find()->where(['slug'=>$slug])->one();
        $poster->updateAllCounters(['views'=>1],['id'=>$poster->id]);
        return $this->render('view', [
            'poster' => $poster
        ]);
    }

    public function actionCategory(){
        $query = \common\models\db\Poster::find()->orderBy('dt_event')->andWhere(['>','dt_event',time()]);
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category',[
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArchive_category(){
        $query = \common\models\db\Poster::find()->orderBy('dt_event DESC');
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category',[
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionSingle_category($slug){
        $cat = CategoryPoster::find()->where(['slug'=>$slug])->one();
        $query = CategoryPosterRelations::find()
            ->leftJoin('poster', '`category_poster_relations`.`poster_id` = `poster`.`id`')
            ->orderBy('dt_event')
            ->where(['cat_id'=>$cat->id])
            ->andWhere(['>','dt_event',time()])
            ->with('poster');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category',[
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSingle_archive_category($slug){
        $cat = CategoryPoster::find()->where(['slug'=>$slug])->one();
        $query = CategoryPosterRelations::find()
                                        ->leftJoin('poster', '`category_poster_relations`.`poster_id` = `poster`.`id`')
                                        ->orderBy('dt_event DESC')
                                        ->where(['cat_id'=>$cat->id])
                                        ->with('poster');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category',[
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public static function actionUpdposterdt_event(){

        $posters = Poster::find()->all();
        foreach ($posters as $k){
            if($k->dt_event == 0){
                Poster::updateAll(['dt_event'=>$k->dt_add],['id'=>$k->id]);
            }
        }

    }
}
