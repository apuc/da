<?php

namespace frontend\modules\company\controllers;

use common\classes\Debug;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use frontend\widgets\VipCompanyWidget;
use Yii;
use frontend\modules\company\models\Company;
use frontend\modules\company\models\CompanySearch;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller {
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
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex() {
        $company       = CategoryCompany::find()->where( [ 'parent_id' => 0, 'lang_id' => 1 ] )->all();
        $sub_company   = CategoryCompany::find()->where( [ 'parent_id' => 533 ] )->all();
        $organizations = Company::find()->where( [ 'user_id' => 1 ] )->orderBy( 'RAND()' )->limit( 6 )->all();

        return $this->render( 'index', [
            'company'       => $company,
            'sub_company'   => $sub_company,
            'organizations' => $organizations
        ] );
    }

    public function actionCategory( $slug ) {
        $cat = CategoryCompany::find()->where( [ 'slug' => $slug ] )->one();
        if ( empty( $cat ) ) {
            return $this->goHome();
        }
        $cats = [ ];
        if ( $cat->parent_id == 0 ) {
            $child_cat = CategoryCompany::find()->where( [ 'parent_id' => $cat->id ] )->all();
            foreach ( $child_cat as $c ) {
                $cats[] = $c->id;
            }
        }
        $query = CategoryCompanyRelations::find()
                                         ->leftJoin( 'company', '`category_company_relations`.`company_id` = `company`.`id`' )
                                         ->where( [ 'cat_id' => ( $cat->parent_id == 0 ) ? $cats : $cat->id ] )
                                         ->orderBy( '`company`.`id` DESC' )
                                         ->groupBy( '`company`.`id`' )
                                         ->with( 'company' );

        $countQuery           = clone $query;
        $pages                = new Pagination( [ 'totalCount' => $countQuery->count(), 'pageSize' => 10 ] );
        $pages->pageSizeParam = false;

        $news = $query->offset( $pages->offset )
                      ->limit( $pages->limit )
                      ->all();

        return $this->render( 'category', [
            'company' => $news,
            'cat'     => $cat,
            'pages'   => $pages,
        ] );
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Company();

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            $catCompanyRel             = new CategoryCompanyRelations();
            $catCompanyRel->cat_id     = $_POST['categ'];
            $catCompanyRel->company_id = $model->id;
            $catCompanyRel->save();

            return $this->redirect( [ '/' ] );
        } else {
            return $this->render( 'create', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate( $id ) {
        $model = $this->findModel( $id );

        if ( $model->load( Yii::$app->request->post() ) && $model->save() ) {
            CategoryCompanyRelations::deleteAll( [ 'company_id' => $model->id ] );
            $catCompanyRel             = new CategoryCompanyRelations();
            $catCompanyRel->cat_id     = $_POST['categ'];
            $catCompanyRel->company_id = $model->id;
            $catCompanyRel->save();

            return $this->redirect( [ 'view', 'id' => $model->id ] );
        } else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Deletes an existing Company model.
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

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id ) {
        if ( ( $model = Company::findOne( $id ) ) !== null ) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    public function actionGet_categ() {
        echo Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map( CategoryCompany::find()->where( [ 'lang_id' => $_POST['langId'] ] )->all(), 'id', 'title' ),
            [ 'class' => 'form-control', 'id' => 'categ_company' ]
        );
    }

    public function actionGet_sub_categ() {
        $sub_company = CategoryCompany::find()->where( [ 'parent_id' => $_POST['id'] ] )->all();

        return $this->renderPartial( 'sub_company', [
            'sub_company' => $sub_company
        ] );
    }

    public function actionGet_company_by_categ() {

        $select_categories    = CategoryCompany::find()
            ->where(['parent_id'=>$_POST['id']])
            ->all();
        $id_parrent_company = ArrayHelper::getColumn($select_categories,'id');
        $select_organizations = Company::find()
                                       ->leftJoin( 'category_company_relations', '`category_company_relations`.`company_id`=`company`.`id`' )
                                       ->where( [ '`category_company_relations`.`cat_id`' => $_POST['id']  ] )->orFilterWhere(['`category_company_relations`.`cat_id`' => $id_parrent_company])
                                       ->with( 'category_company_relations' )
                                        ->all();

        return $this->renderPartial( 'organizations', [
            'organizations' => $select_organizations
        ] );
    }
    public static function actionStartwidgetcompany(){
        //return \frontend\modules\mainpage\widgets\Company::widget();
        return VipCompanyWidget::widget();
       // return '1';
    }
}
