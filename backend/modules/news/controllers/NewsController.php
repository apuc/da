<?php

namespace backend\modules\news\controllers;

use backend\modules\category\models\CategoryNews;
use backend\modules\tags\models\TagsRelation;
use backend\modules\vk\models\VkStream;
use common\classes\Debug;
use common\models\db\CategoryNewsRelations;
use common\models\db\Lang;
use Yii;
use backend\modules\news\models\News;
use backend\modules\news\models\NewsSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\tags\models\Tags;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
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

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = ($action->id !== "update");

        return parent::beforeAction($action);
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        $lang = Lang::find()->all();
        $tags = Tags::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            //Debug::prn($_POST['News']['dt_public']);
            //   $model->status    = ( ! empty( $_POST['dt_public_time'] ) ) ? 3 : 0;
            $model->user_id = Yii::$app->user->getId();
            $model->dt_public = (!empty($_POST['dt_public_time'])) ? strtotime($_POST['News']['dt_public'] . ' ' . $_POST['dt_public_time']) : time();
            $model->save();

            if (!empty(Yii::$app->request->post('categ'))) {
                foreach ($_POST['categ'] as $cat) {
                    $catNewRel = new CategoryNewsRelations();
                    $catNewRel->cat_id = $cat;
                    $catNewRel->new_id = $model->id;
                    $catNewRel->save();
                }
            } else {
                $catNewRel = new CategoryNewsRelations();
                $catNewRel->cat_id = CategoryNews::findOne(['slug' => 'bez-categorii'])->id;
                $catNewRel->new_id = $model->id;
                $catNewRel->save();
            }

            if(!empty(Yii::$app->request->post('Tags')))
            {
                foreach (Yii::$app->request->post('Tags') as $tag)
                {
                    $tags = New TagsRelation();
                    $tags->saveTagsRel($tag, $model->id, 'news');
                }
            }

            return $this->redirect(['index']);
        } else {
            if(!empty(Yii::$app->request->get()))
            {
                $vk = VkStream::find()->with('photo')->where(['id' => Yii::$app->request->get('id')])->one();
                $model->content = nl2br($vk->text);
                $model->photo = (!empty($vk->photo)) ? $vk->photo[0]->getLargePhoto() : '';
                $vk->scenario = 'saveNews';
                $vk->status = 3;
                $vk->save();
            }
            return $this->render('create', [
                'model' => $model,
                'lang' => $lang,
                'cats_arr' => [],
                'tags' => $tags,
                'tags_selected' => [],
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $lang = Lang::find()->all();
        $cats = CategoryNewsRelations::find()->where(['new_id' => $id])->all();
        $cats_arr = [];
        $tags = Tags::find()->asArray()->all();
        $tags_selected =ArrayHelper::getColumn(TagsRelation::find()->select('tag_id')
            ->where(['post_id' => $id, 'type' => 'news'])
            ->asArray()
            ->all(), 'tag_id');

        foreach ($cats as $cat_item) {
            $cats_arr[] = $cat_item->cat_id;
        }
        if ($model->load(Yii::$app->request->post())) {
            //$model->status = (!empty($_POST['dt_public_time'])) ? 3 : 0;

            // $model->dt_public = ( ! empty( $_POST['dt_public_time'] ) ) ? strtotime( $_POST['News']['dt_public'] . ' ' . $_POST['dt_public_time'] ) : time();

            if (!empty($_POST['dt_public_time'])) {
                $model->dt_public = strtotime($_POST['News']['dt_public'] . ' ' . $_POST['dt_public_time']);
            }

//            if ( ! empty( $model->dt_public ) ) {
//                if ( $model->dt_public <= time() ) {
//                    $model->status = 0;
//                }else{
//                    //$model->status = 3;
//                }
//            }

            $model->save();
            CategoryNewsRelations::deleteAll(['new_id' => $model->id]);
            if (!empty(Yii::$app->request->post('categ'))) {
                foreach ($_POST['categ'] as $cat) {
                    $catNewRel = new CategoryNewsRelations();
                    $catNewRel->cat_id = $cat;
                    $catNewRel->new_id = $model->id;
                    $catNewRel->save();
                }
            } else {
                $catNewRel = new CategoryNewsRelations();
                $catNewRel->cat_id = CategoryNews::findOne(['slug' => 'bez-categorii'])->id;
                $catNewRel->new_id = $model->id;
                $catNewRel->save();
            }

            if(!empty(Yii::$app->request->post('Tags')))
            {
                TagsRelation::deleteAll(['post_id' => $id, 'type' => 'news']);
                foreach (Yii::$app->request->post('Tags') as $tag)
                {
                    $tags = New TagsRelation();
                    $tags->saveTagsRel($tag, $id, 'news');
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'lang' => $lang,
                'cats_arr' => $cats_arr,
                'tags' => $tags,
                'tags_selected' => $tags_selected
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        CategoryNewsRelations::deleteAll(['new_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGet_categ()
    {
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map(CategoryNews::find()->where(['lang_id' => $_POST['langId']])->all(), 'id', 'title'),
            ['class' => 'form-control', 'id' => 'categ']
        );
    }

}
