<?php

namespace backend\modules\poster\controllers;

use backend\modules\category\Category;
use common\classes\Debug;
use common\classes\WordFunctions;
use common\models\db\CategoryPosterRelations;
use common\models\db\GeobaseRegion;
use common\models\db\KeyValue;
use Yii;
use backend\modules\poster\models\Poster;
use backend\modules\poster\models\PosterSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\tags\models\Tags;
use backend\modules\tags\models\TagsRelation;

/**
 * PosterController implements the CRUD actions for Poster model.
 */
class PosterController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent:: beforeAction($action);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Poster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PosterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Poster model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Poster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Poster();
        $tags = Tags::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->dt_event = strtotime($model->dt_event);
            $model->dt_event_end = strtotime($model->dt_event_end);
            $model->user_id = Yii::$app->user->id;
            $model->save();

            foreach ($_POST['cat'] as $cat) {
                $catNewRel = new CategoryPosterRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->poster_id = $model->id;
                $catNewRel->save();
            }

            if(!empty(Yii::$app->request->post('Tags')))
            {
                foreach (Yii::$app->request->post('Tags') as $tag)
                {
                    $tags = New TagsRelation();
                    $tags->saveTagsRel($tag, $model->id, 'poster');
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            $region = GeobaseRegion::find()->all();
            return $this->render('create', [
                'model' => $model,
                'categoriesSelected' => [],
                'tags' => $tags,
                'tags_selected' => [],
                'region' => $region,
            ]);
        }
    }

    /**
     * Updates an existing Poster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tags = Tags::find()->asArray()->all();
        $tags_selected =ArrayHelper::getColumn(TagsRelation::find()->select('tag_id')
            ->where(['post_id' => $id, 'type' => 'poster'])
            ->asArray()
            ->all(), 'tag_id');

        if ($model->load(Yii::$app->request->post())) {
            $model->dt_event = strtotime($model->dt_event);
            $model->dt_event_end = strtotime($model->dt_event_end);

            CategoryPosterRelations::deleteAll(['poster_id' => $id]);

            foreach ($_POST['cat'] as $cat) {
                $catNewRel = new CategoryPosterRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->poster_id = $model->id;
                $catNewRel->save();
            }
            $model->save();

            if(!empty(Yii::$app->request->post('Tags')))
            {
                TagsRelation::deleteAll(['post_id' => $id, 'type' => 'poster']);
                foreach (Yii::$app->request->post('Tags') as $tag)
                {
                    $tags = New TagsRelation();
                    $tags->saveTagsRel($tag, $id, 'poster');
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $region = GeobaseRegion::find()->all();
            return $this->render('update', [
                'model' => $model,
                'categoriesSelected' => ArrayHelper::getColumn(
                    CategoryPosterRelations::findAll(['poster_id' => $id]),
                    'cat_id'),
                'tags' => $tags,
                'tags_selected' => $tags_selected,
                'region' => $region,
            ]);
        }
    }

    /**
     * Deletes an existing Poster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Poster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Poster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Poster::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMainPremiere()
    {
        $request = Yii::$app->request->post();
         if (isset($request['poster_images'][0])) {
             $json['main_posters'] = $request['poster_images'][0];
             $json['description'] = $request['description'];
             $json['afisha_id'] = $request['afisha_id'];
             $main_poster = KeyValue::findOne(['key' => 'main_posters']);
             $main_poster->value = json_encode($json);
             $main_poster->save();

         }
         $key_val = KeyValue::find()->where(['key' => 'main_posters'])->one();
         $main_posters = json_decode($key_val->value);

        return $this->render('main_poster', [
            'key_val' => ArrayHelper::map($key_val, 'key', 'value'),
            'main_posters' => $main_posters,
        ]);
    }

    public function actionMainPoster()
    {
        $request = Yii::$app->request;
        $mainBannerPoster = KeyValue::findOne(['key' => 'main_banner_poster']);

        if ($request->isPost) {
            $json['poster_image'] = Yii::$app->request->post()['poster_image'];
            $json['main_poster_title'] = Yii::$app->request->post()['main_poster_title'];
            $json['main_poster_subtitle'] = Yii::$app->request->post()['main_poster_subtitle'];
            $json['main_poster_substrate'] = Yii::$app->request->post()['main_poster_substrate'];

            $mainBannerPoster->value = json_encode($json);
            $mainBannerPoster->save();

        }

        return $this->render('main_poster_banner', ['mainBannerPoster' => json_decode($mainBannerPoster->value)]);

    }

    public function actionInterestedIn()
    {
        $request = Yii::$app->request;
        $interestedInPosters = KeyValue::findOne(['key' => 'intrested_in_posters']);

        if ($request->isPost) {
            //обновляем индексы, если были удалены категории
            $json = array_values($request->post()['interested_in']);
            //убираем пустую категорию
            foreach ($json as $key => $value) {
                if (empty($value['title']) || empty($value['thumb']) || empty($value['posters'])) {
                    unset($json[$key]);
                } else {
                    $json[$key]['count'] = count($value['posters']) . ' ' . WordFunctions::getNumEnding(count($value['posters']),
                            ['событие', 'события', 'событий']);
                }
            }

            $interestedInPosters->value = json_encode($json);
            $interestedInPosters->save();
        }

        return $this->render('interested_in', [
            'interestedInPosters' => json_decode($interestedInPosters->value),
            'postersList' => ArrayHelper::map(Poster::find()->orderBy('id DESC')->all(), 'id', 'title'),
        ]);
    }

    public function actionTopSlider()
    {
        $request = Yii::$app->request;
        $topSlider = KeyValue::findOne(['key' => 'poster_page_top_slider']);
        if ($request->isPost) {
            $json = json_encode($request->post()['posters']);
            $topSlider->value = $json;
            $topSlider->save();
        }
        return $this->render('top_slider', [
            'postersList' => ArrayHelper::map(Poster::find()->orderBy('id DESC')->all(), 'id', 'title'),
            'topSlider' => json_decode($topSlider->value),
        ]);
    }
}
