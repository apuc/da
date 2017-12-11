<?php

namespace frontend\modules\news\controllers;

use app\models\UploadPhoto;
use common\classes\Debug;
use common\models\db\CategoryNews;
use common\models\db\CategoryNewsRelations;
use common\models\db\KeyValue;
use common\models\db\Lang;
use frontend\controllers\MainController;
use Yii;
use common\models\db\News;
use frontend\modules\news\models\NewsSearch;
use yii\data\Pagination;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\validators\RequiredValidator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public $layout = 'portal_page';

    public function init()
    {
        $this->on('beforeAction', function ($event) {

            // запоминаем страницу неавторизованного пользователя, чтобы потом отредиректить его обратно с помощью  goBack()
            if (Yii::$app->getUser()->isGuest) {
                $request = Yii::$app->getRequest();
                // исключаем страницу авторизации или ajax-запросы
                if (!($request->getIsAjax() || strpos($request->getUrl(), 'login') !== false)) {
                    Yii::$app->getUser()->setReturnUrl($request->getUrl());
                }
            }
        });
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'category', 'more-news', 'more-category-news', 'archive'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
        $cookies = Yii::$app->request->cookies;
        $useReg = $cookies->getValue('regionId');

        $newsQuery = News::find()
            ->where([
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
                'hot_new' => 0,
            ]);
        if($useReg != -1){
            $newsQuery->andWhere(['region_id' => NULL]);
            $newsQuery->orWhere(['region_id' => $useReg]);

        }
        $news = $newsQuery
            ->limit(34)
            ->orderBy('dt_public DESC')
            ->with('category')
            ->all();

        $hotNewsQuery = News::find()
            ->where([
                'status' => 0,
                'lang_id' => Lang::getCurrent()['id'],
                'hot_new' => 1,
            ]);
        if($useReg != -1){
            $hotNewsQuery->andWhere(['region_id' => NULL]);
            $hotNewsQuery->orWhere(['region_id' => $useReg]);

        }
        $hotNews = $hotNewsQuery->limit(5)
            ->orderBy('dt_public DESC')
            ->with('category')
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
            $cookies = Yii::$app->request->cookies;
            $useReg = $cookies->getValue('regionId');

            $request = Yii::$app->request->post();

            $newsQuery = News::find()
                ->where([
                    'status' => 0,
                    'lang_id' => Lang::getCurrent()['id'],
                    'hot_new' => 0,
                ]);
            if($useReg != -1){
                $newsQuery->andWhere(['region_id' => NULL]);
                $newsQuery->orWhere(['region_id' => $useReg]);

            }
            $news = $newsQuery
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
                ->with('category')
                ->all();

            return $this->renderPartial('simple_news',
                [
                    'news' => $news,
                ]);

        }
    }

    /**
     * Displays a single News model.
     *
     * @param integer $id
     *
     * @return mixed
     */
   /* public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'personal_area';
        $model = new \frontend\modules\news\models\News();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
/*
            Debug::prn($model);
            Debug::prn($_FILES);*/
            //Debug::prn($_POST);


            $model->status = 1;
            $model->user_id = Yii::$app->user->getId();
            $model->dt_public = $model->dt_update;
            $model->meta_title = $model->title;
            $model->meta_descr =  \yii\helpers\StringHelper::truncate(strip_tags($model->content), 250);

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

            if (!empty($_POST['News']['categoryId'])) {
                foreach ($_POST['News']['categoryId'] as $cat) {
                    $catNewRel = new CategoryNewsRelations();
                    $catNewRel->cat_id = $cat;
                    $catNewRel->new_id = $model->id;
                    $catNewRel->save();
                }
            }

            Yii::$app->session->setFlash('success','Ваша новость успешно добавлена. После прохождения модерации она будет опубликована.');
            return $this->redirect('/personal_area/default/index');
            /*$model->status = 1;
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

            return $this->redirect(['/']);*/
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

        $this->layout = 'personal_area';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->status = 1;
            $model->user_id = Yii::$app->user->getId();
            $model->dt_public = $model->dt_update;
            $model->meta_title = $model->title;
            $model->meta_descr = \yii\helpers\StringHelper::truncate(strip_tags($model->content), 250);

            if (!empty($_FILES['News']['name']['photo'])) {
                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['News']['name']['photo'];
            } else {
                $model->photo = $_POST['photo'];
            }

            $model->save();
            $oldSelectCategNews = CategoryNewsRelations::find()->where(['new_id' => $id])->all();

            if (!empty($_POST['News']['categoryId']) && (!empty($oldSelectCategNews))) {

                CategoryNewsRelations::deleteAll(['new_id' => $model->id]);
                foreach ($_POST['News']['categoryId'] as $cat) {

                    $catNewRel = new CategoryNewsRelations();
                    $catNewRel->cat_id = $cat;
                    $catNewRel->new_id = $model->id;
                    $catNewRel->save();
                }
            }

            Yii::$app->session->setFlash('success','Ваша новость успешно сохранена. После прохождения модерации она будет опубликована.');
            return $this->redirect('/personal_area/default/index');
        }
        else{

            $newsPhoto= News::find()->select(['photo'])->where(['id'=>$id])->one();
            $img = $newsPhoto->photo;
            $selectCat_arr = Array();
            $i=0;
            $newsRel_1 = CategoryNewsRelations::find()->where(['new_id' => $id])->all();

            foreach ($newsRel_1 as $item){
                $selectCat_arr[$i]= CategoryNews::find()->where(['id'=>$item->cat_id])->one();
                $i++;
            }
            $newsRel=CategoryNewsRelations::find()->where(['new_id'=>$id])->one();
            $selectCat= CategoryNews::find()->where(['id'=>$newsRel->cat_id])->one();
           // var_dump($selectCat);
            return $this->render('update',['model' => $model,'selectCat'=>$selectCat_arr, 'img'=>$img]);
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

        Yii::$app->session->setFlash('success','Ваша новость успешно удалена.');
        return $this->redirect('/personal_area/default/index');
    }

    public function actionCategory($slug)
    {
        if( Yii::$app->request->get('page')){
            throw new \yii\web\HttpException(404 ,'Страница не найдена.');
        }
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

        //Debug::prn($news);

        $hotNewsIndexes = [5, 7, 13, 20, 22];
        $bigNewsIndexes = [14, 28, 38];

        return $this->render('category',
            [
                'cat' => $cat,
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
            'date' => $date,
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
