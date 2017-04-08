<?php

namespace frontend\modules\news\controllers;

use app\models\UploadPhoto;
use common\classes\Debug;
use common\models\db\CategoryNews;
use common\models\db\CategoryNewsRelations;
use common\models\db\KeyValue;
use common\models\db\Lang;
use Yii;
use frontend\modules\news\models\News;
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
class NewsController extends Controller {
    public $layout = 'portal_page';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'POST' ],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex() {

        $query = News::find()
                     ->where( [ 'lang_id' => Lang::getCurrent()['id'], 'status' => 0 ] )
                     ->orderBy( 'dt_public DESC' );


        $dataProvider = new SqlDataProvider( [
            'sql'        => $query->createCommand()->rawSql,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                // количество пунктов на странице
                'pageSize' => 12,
            ]
        ] );

        return $this->render( 'index',
            [
                'news_5'       => \common\models\db\News::find()->where( [ 'status' => 0 ] )->orderBy( 'dt_add DESC' )->limit( 5 )->all(),
                'cat'          => CategoryNews::find()->where( [ 'lang_id' => Lang::getCurrent()['id'] ] )->all(),
                'dataProvider' => $dataProvider,
                'meta_title'   => KeyValue::findOne( [ 'key' => 'news_page_meta_title' ] )->value,
                'meta_descr'   => KeyValue::findOne( [ 'key' => 'news_page_meta_descr' ] )->value,
            ] );
    }

    /**
     * Displays a single News model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView( $id ) {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new News();

        if ( $model->load( Yii::$app->request->post() ) ) {
            $model->status  = 1;
            $model->user_id = Yii::$app->user->getId();


            if ( $_FILES['News']['name']['photo'] ) {
                $upphoto            = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance( $model, 'photo' );
                $loc                = 'media/upload/userphotos/' . date( 'dmY' ) . '/';
                if ( ! is_dir( $loc ) ) {
                    mkdir( $loc );
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['News']['name']['photo'];
            }
            $model->save();
            $catNewRel         = new CategoryNewsRelations();
            $catNewRel->cat_id = $_POST['categ'];
            $catNewRel->new_id = $model->id;
            $catNewRel->save();

            return $this->redirect( [ '/' ] );
        } else {
            return $this->render( 'create', [
                'model' => $model,
            ] );
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
    public function actionUpdate( $id ) {
        $model = $this->findModel( $id );

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            return $this->redirect( [ 'view', 'id' => $model->id ] );
        } else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
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
    public function actionDelete( $id ) {
        $this->findModel( $id )->delete();

        return $this->redirect( [ 'index' ] );
    }

    public function actionCategory( $slug ) {
        $cat = \backend\modules\category\models\CategoryNews::getBySlug( $slug );
        if ( empty( $cat ) ) {
            return $this->goHome();
        }
        $query = CategoryNewsRelations::find()
                                      ->leftJoin( 'news', '`category_news_relations`.`new_id` = `news`.`id`' )
                                      ->where( [ 'cat_id' => $cat->id ] )
                                      ->andWhere( [ 'status' => 0 ] )
                                      ->orderBy( '`news`.`id` DESC' )
                                      ->with( 'news' );

        $countQuery           = clone $query;
        $pages                = new Pagination( [ 'totalCount' => $countQuery->count(), 'pageSize' => 10 ] );
        $pages->pageSizeParam = false;

        $news = $query->offset( $pages->offset )
                      ->limit( $pages->limit )
                      ->all();

        return $this->render( 'category', [
            'news'  => $news,
            'cat'   => $cat,
            'pages' => $pages,
        ] );
    }

    public function actionArchive( $date ) {
        $query                = News::find()->where( [ 'DATE(FROM_UNIXTIME(dt_public))' => $date ] );
        $countQuery           = clone $query;
        $pages                = new Pagination( [ 'totalCount' => $countQuery->count(), 'pageSize' => 10 ] );
        $pages->pageSizeParam = false;

        $news = $query->offset( $pages->offset )
                      ->limit( $pages->limit )
                      ->all();


        return $this->render( 'archive', [
            'news'  => $news,
            'cat'   => (object) [ 'title' => 'Архив за ' . $date ],
            'pages' => $pages,
        ] );
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
    protected function findModel( $id ) {
        if ( ( $model = News::findOne( $id ) ) !== null ) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    public function actionGet_categ() {
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map( CategoryNews::find()->where( [ 'lang_id' => $_POST['langId'] ] )->all(), 'id', 'title' ),
            [ 'class' => 'form-control', 'id' => 'categ' ]
        );
    }
    

}
