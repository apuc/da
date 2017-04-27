<?php

namespace frontend\modules\news\controllers;

use app\models\UploadPhoto;
use common\classes\Debug;
use common\models\db\CategoryNews;
use common\models\db\CategoryNewsRelations;
use common\models\db\KeyValue;
use common\models\db\Lang;
use Yii;
use common\models\db\News;
use frontend\modules\news\models\NewsSearch;
use yii\data\Pagination;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public $layout = 'portal_page';

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
     * Lists all News models.
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {

        $news = News::find()
            ->where([
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
                'hot_new' => 0,
            ])
            ->limit(34)
            ->orderBy('dt_public DESC')
            ->all();

        $hotNews = News::find()
            ->where([
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
                'hot_new' => 1,
            ])
            ->limit(5)
            ->orderBy('dt_public DESC')
            ->all();

        $hotNewsIndexes = [5, 7, 13, 20, 22];
        $bigNewsIndexes = [14, 28, 38];
        //Debug::prn($hotNews);
        return $this->render('index',
            [
                'news' => $news,
                'hotNews' => $hotNews,
                'hotNewsIndexes' => $hotNewsIndexes,
                'bigNewsIndexes' => $bigNewsIndexes,
                'meta_descr' => KeyValue::getValue('news_page_meta_descr'),
                'meta_title' => KeyValue::getValue('news_page_meta_title'),
            ]);
    }

    public function actionMoreNews()
    {
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();

            $news = News::find()
                ->where([
                    'status' => 0,
                    'lang_id' => Lang::getCurrent()['id'],
                    'hot_new' => 0,
                ])
                ->offset($request['offset'])
                ->limit(16)
                ->orderBy('dt_public DESC')
                ->all();

            return $this->renderPartial('simple_news', ['news' => $news]);

        }
    }

    public function actionMoreCategoryNews()
    {
        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();

            $news = News::find()
                ->joinWith('category')
                ->where([
                    'status' => 0,
                    '`news`.`lang_id`' => Lang::getCurrent()['id'],
                    'hot_new' => 0,
                    '`category_news`.`slug`'=>Yii::$app->request->post('category')
                ])
                ->offset($request['offset'])
                ->limit(16)
                ->orderBy('dt_public DESC')
                ->all();

            return $this->renderPartial('simple_news', ['news' => $news]);

        }
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

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 1;
            $model->user_id = Yii::$app->user->getId();

            if ($_FILES['News']['name']['photo']) {
                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['News']['name']['photo'];
            }
            $model->save();
            $catNewRel = new CategoryNewsRelations();
            $catNewRel->cat_id = $_POST['categ'];
            $catNewRel->new_id = $model->id;
            $catNewRel->save();

            return $this->redirect(['/']);
        } else {
            return $this->render('create', [
                'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCategory($slug)
    {
        $cat = \backend\modules\category\models\CategoryNews::getBySlug($slug);
        if (empty($cat)) {
            return $this->goHome();
        }
        $news = CategoryNewsRelations::find()
            ->leftJoin('news', '`category_news_relations`.`new_id` = `news`.`id`')
            ->where(['cat_id' => $cat->id])
            ->andWhere(['status' => 0])
            ->orderBy('`news`.`id` DESC')
            ->with('news')
            ->all();

        $hotNews = News::find()
            ->where([
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
                'hot_new' => 1,
            ])
            ->limit(5)
            ->orderBy('dt_public DESC')
            ->all();

        $hotNewsIndexes = [5, 7, 13, 20, 22];
        $bigNewsIndexes = [14, 28, 38];

        return $this->render('category',
            [
                'category' => $cat,
                'news' => $news,
                'hotNews' => $hotNews,
                'hotNewsIndexes' => $hotNewsIndexes,
                'bigNewsIndexes' => $bigNewsIndexes,
                'meta_descr' => $cat->meta_descr,
                'meta_title' => $cat->meta_title,
            ]);

        //$countQuery = clone $query;
        //$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        //$pages->pageSizeParam = false;
        //
        //$news = $query->offset($pages->offset)
        //    ->limit($pages->limit)
        //    ->all();
        //
        //return $this->render('category', [
        //    'news' => $news,
        //    'cat' => $cat,
        //    'pages' => $pages,
        //]);
    }

    public function actionArchive($date)
    {
        $news = News::find()
            ->where([
                'DATE(FROM_UNIXTIME(dt_public))' => $date,
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
            ])
            ->orderBy('dt_public DESC')
            ->all();

        return $this->render('archive_news', [
            'news' => $news,
        ]);
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
