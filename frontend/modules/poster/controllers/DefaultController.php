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

        $likes = Likes::find()
            ->where(['post_id' => $poster->id, 'post_type' => 'poster'])
            ->count();

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

        if (!Yii::$app->user->isGuest) {
            $thisUserLike = Likes::find()
                ->where(['post_id' => $poster->id, 'post_type' => 'poster', 'user_id' => Yii::$app->user->id])
                ->count();
        } else {
            $thisUserLike = false;
        }

        $poster->updateAllCounters(['views' => 1], ['id' => $poster->id]);

        return $this->render('view', [
            'model' => $poster,
            'category' => $category->category_poster,
            'likes' => $likes,
            'thisUserLike' => $thisUserLike,
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
       /* $query = \common\models\db\Poster::find()->andWhere([
            '>',
            'dt_event_end',
            time(),
        ])
            ->orderBy('dt_event_end')
        ;
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);*/

        return $this->render('category2', [
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            //'dataProvider' => $dataProvider,
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
            ->andWhere(['>=', 'dt_event_end', time()])
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
    // загружаем больше категорий "Вас может заинтересовать"
    public function actionMoreInterestedIn()
    {
        $interestedInPostersJson = KeyValue::findOne(['key' => 'intrested_in_posters']);
        $interestedInPosters = json_decode($interestedInPostersJson->value);

        if (count($interestedInPosters) <= 4) {
            die();
        }

        $moreInterestedPosters = array_slice($interestedInPosters, 4, null, true);

        return $this->renderAjax('more_interested_in', [
            'interestedInPosters' => $moreInterestedPosters,
        ]);
    }
    // показываем события из категории "Вас может заинтересовать"
    public function actionInterestedInPosters()
    {
        $posterID = (int) Yii::$app->request->post('posterID');

        $interestedInPostersJson = KeyValue::findOne(['key' => 'intrested_in_posters']);
        $interestedInPosters = json_decode($interestedInPostersJson->value);

        $posters = Poster::find()
            ->joinWith('categories')
            ->where(['poster.id' => $interestedInPosters[$posterID]->posters])
            ->all();

        return $this->renderPartial('more_kino', [
            'posters' => $posters
        ]);
    }

    public function actionGetMorePoster()
    {
        $step = Yii::$app->request->post('step');
        $poster = Poster::find()
            ->where(['>=', 'dt_event_end', time()])
            ->orderBy('dt_event')
            ->offset(((int)$step - 1) * 4)
            ->limit(4)
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
            /*->where(['>', 'dt_event', time()])*/
            ->andWhere(['`category_poster`.`slug`' => 'kino'])
            ->orderBy('dt_event DESC')
            ->limit(5)
            ->offset(((int)$step - 1) * 5)
            ->all();

        $data['html'] = $this->renderPartial('more_kino', [
            'posters' => $posters
        ]);
        $data['last'] = count($posters) < 5 ? 1 : 0;
        return json_encode($data);
    }


    public function actionMorePoster()
    {
        $page = Yii::$app->request->post('page');
        $limit = Yii::$app->request->post('limit');
        $count = Yii::$app->request->post('count');



        $poster = Poster::find()
            ->where(['popular' => 1])
            ->andWhere(['>=', 'dt_event', time()])
            ->orderBy('dt_event ASC')
            ->offset(((int)$page - 1) * $limit)
            ->limit($limit)
            ->with('categories')
            ->all();

        $data['html'] = $this->renderPartial('more_poster_w', [
            'posters' => $poster
        ]);
        $data['last'] = $count - ((int)$page - 1) * $limit <= $limit ? 1 : 0;
        return json_encode($data);
    }
}
