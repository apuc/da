<?php

namespace frontend\modules\poster\controllers;

use backend\modules\poster\controllers\PosterController;
use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\Poster;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
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

        $cats_posters_ids = ArrayHelper::getColumn(CategoryPosterRelations::find()->where(['poster_id'=>$poster->id])->select('cat_id')->asArray()->all(),'cat_id');
        $cats_posters = ArrayHelper::getColumn(CategoryPosterRelations::find()->where(['cat_id'=>$cats_posters_ids])->select('poster_id')->asArray()->all(),'poster_id');
        $related_posters = Poster::find()->where(['id'=>$cats_posters])->andWhere(['!=','id',$poster->id])->andWhere(['>','dt_event',time()])->orderBy(['rand()'=>SORT_DESC])->limit(3)->all();

        $most_popular_posters = Poster::find()->andWhere(['>','dt_event', time()] )->andWhere(['!=','id',$poster->id])->orderBy('views DESC')->limit(3)->all();

        return $this->render('view', [
            'poster' => $poster,
            'related_posters'=>$related_posters,
            'most_popular_posters'=>$most_popular_posters
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
