<?php

namespace frontend\modules\poster\controllers;

use backend\modules\poster\controllers\PosterController;
use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use common\models\db\Likes;
use common\models\db\Poster;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\helpers\Url;
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

    public function actionView($slug)
    {
        $poster = Poster::find()->where(['slug' => $slug])->one();

        if (empty($poster)) {
            return $this->redirect(['site/error']);
        }

        if (!empty(Yii::$app->request->post()['category'])) {
            $category = CategoryPoster::findOne(Yii::$app->request->post()['category']);
        } else {
            $category = CategoryPosterRelations::find()
                ->where(['poster_id' => $poster->id])
                ->orderBy('RAND()')
                ->limit(1)
                ->with('category_poster')
                ->one();
        }

        $poster->updateAllCounters(['views' => 1], ['id' => $poster->id]);

        return $this->render('view', [
            'model' => $poster,
            'category' => $category->category_poster,
        ]);
    }

    public function _actionView($slug)
    {
        $poster = Poster::find()->where(['slug' => $slug])->one();

        if (empty($poster)) {
            return $this->redirect(['site/error']);
        }

        $poster->updateAllCounters(['views' => 1], ['id' => $poster->id]);

        $cats_posters_ids = ArrayHelper::getColumn(CategoryPosterRelations::find()->where(['poster_id' => $poster->id])->select('cat_id')->asArray()->all(),
            'cat_id');
        $cats_posters = ArrayHelper::getColumn(CategoryPosterRelations::find()->where(['cat_id' => $cats_posters_ids])->select('poster_id')->asArray()->all(),
            'poster_id');

        $related_posters = Poster::find()->where(['id' => $cats_posters])->andWhere([
            '!=',
            'id',
            $poster->id,
        ])->andWhere(['>', 'dt_event', time()])->orderBy(['rand()' => SORT_DESC])->limit(6)->all();

        $most_popular_posters = Poster::find()->andWhere(['>', 'dt_event', time()])->andWhere([
            '!=',
            'id',
            $poster->id,
        ])->orderBy('views DESC')->limit(6)->all();

        $count_likes = count(Likes::find()
            ->where(['post_type' => 'posters', 'post_id' => $poster->id])
            ->all());
        $user_set_like = Likes::find()
            ->where([
                'post_type' => 'posters',
                'user_id' => Yii::$app->user->id,
                'post_id' => $poster->id,
            ])
            ->one();

        return $this->render('view', [
            'poster' => $poster,
            'related_posters' => $related_posters,
            'most_popular_posters' => $most_popular_posters,
            'count_likes' => $count_likes,
            'user_set_like' => $user_set_like,
        ]);
    }

    public function actionCategory()
    {
        $query = \common\models\db\Poster::find()->orderBy('dt_event_end')->andWhere([
            '>',
            'dt_event_end',
            time(),
        ]);
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category2', [
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
            'meta_title' => KeyValue::findOne(['key' => 'poster_page_meta_title'])->value,
            'meta_descr' => KeyValue::findOne(['key' => 'poster_page_meta_descr'])->value,
        ]);
    }

    public function actionArchive_category()
    {
        $query = \common\models\db\Poster::find()->orderBy('dt_event DESC');
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSingle_category($slug)
    {
        $cat = CategoryPoster::find()->where(['slug' => $slug])->one();
        $query = CategoryPosterRelations::find()
            ->leftJoin('poster', '`category_poster_relations`.`poster_id` = `poster`.`id`')
            ->orderBy('dt_event')
            ->where(['cat_id' => $cat->id])
            ->andWhere(['>', 'dt_event_end', time()])
            ->with('poster');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category_single', [
            'slug' => $slug,
            'meta_title' => KeyValue::findOne(['key' => 'poster_page_meta_title'])->value,
            'meta_descr' => KeyValue::findOne(['key' => 'poster_page_meta_descr'])->value,
        ]);
    }

    public function actionSingle_archive_category($slug)
    {
        $cat = CategoryPoster::find()->where(['slug' => $slug])->one();
        $query = CategoryPosterRelations::find()
            ->leftJoin('poster', '`category_poster_relations`.`poster_id` = `poster`.`id`')
            ->orderBy('dt_event DESC')
            ->where(['cat_id' => $cat->id])
            ->with('poster');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public static function actionUpdposterdt_event()
    {

        $posters = Poster::find()->all();
        foreach ($posters as $k) {
            if ($k->dt_event == 0) {
                Poster::updateAll(['dt_event' => $k->dt_add], ['id' => $k->id]);
            }
        }

    }

    public static function actionUpdposterdt_event_end()
    {

        $posters = Poster::find()->all();
        foreach ($posters as $k) {
            if ($k->dt_event_end == 0) {
                Poster::updateAll(['dt_event_end' => $k->dt_event], ['id' => $k->id]);
            }
        }

    }

    public function actionMoreInterestedIn()
    {
        $interestedInPostersJson = KeyValue::findOne(['key' => 'intrested_in_posters']);
        $interestedInPosters = json_decode($interestedInPostersJson->value);

        if (count($interestedInPosters) <= 4) {
            die();
        }

        $moreInterestedPosters = array_slice($interestedInPosters, 4);

        return $this->renderAjax('more_interested_in', [
            'interestedInPosters' => $moreInterestedPosters,
        ]);
    }

    public function actionGetMorePoster()
    {
        $step = Yii::$app->request->post('step');
        $poster = Poster::find()
            ->where(['>', 'dt_event', time()])
            ->limit(4)
            ->offset(((int)$step - 1) * 4)
            ->with('categories')
            ->all();

        $data['html'] = $this->renderPartial('more_poster', [
            'posters' => $poster
        ]);
        $data['last'] = count($poster) < 4 ? 1 : 0;
        return json_encode($data);
    }

    public function actionGetMoreKino()
    {
        $step = Yii::$app->request->post('step');

        $posters = Poster::find()
            ->joinWith('categories')
            ->where(['>', 'dt_event', time()])
            ->andWhere(['`category_poster`.`slug`' => 'kino'])
            ->limit(5)
            ->offset(((int)$step - 1) * 5)
            ->all();

        $data['html'] = $this->renderPartial('more_kino', [
            'posters' => $posters
        ]);
        $data['last'] = count($posters) < 5 ? 1 : 0;
        return json_encode($data);
    }
}
