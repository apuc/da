<?php

namespace frontend\modules\consulting\controllers;

use common\classes\Debug;
use common\models\db\CategoryFaq;
use common\models\db\CategoryPostsConsulting;
use common\models\db\CategoryPostsDigest;
use common\models\db\Company;
use common\models\db\Consulting;
use common\models\db\Faq;
use common\models\db\PostsConsulting;
use Yii;
use yii\data\SqlDataProvider;
use yii\db\Connection;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ConsultingController extends \yii\web\Controller {
    public function actionIndex() {
//        return $this->render('index');
        $consulting = Consulting::find()->all();

        return $this->render( 'index', [ 'consulting' => $consulting ] );
    }

    public function actionView() {
        $request = Yii::$app->request;

        $consulting     = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        $company        = Company::find()->where( [ 'id' => $consulting->company_id ] )->one();
        $db             = new Connection( Yii::$app->db );
        $categories_faq = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `faq` WHERE cat_id = category_faq.id) AS memberCount FROM `category_faq` as category_faq WHERE category_faq.type = '$consulting->slug'
        " )->queryAll();

        $categories_posts  = CategoryPostsConsulting::find()->where( [ 'type' => $consulting->slug ] )->all();
        $categories_digest = CategoryPostsDigest::find()->where( [ 'type' => $consulting->slug ] )->all();

        return $this->render( 'view', [
            'consulting'        => $consulting,
            'company'           => $company,
            'categories_faq'    => $categories_faq,
            'categories_posts'  => $categories_posts,
            'categories_digest' => $categories_digest,
        ] );
    }


    public function actionFaq() {
        $request = Yii::$app->request;

        if ( $request->get()['id'] ) {
            $id         = $request->get()['id'];
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        } elseif ( $request->get()['slug'] ) {
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        } elseif ( $request->get()['slugcategory'] ) {
            $selCatFaq  = CategoryFaq::find()->where( [ 'slug' => $request->get()['slugcategory'] ] )->one();
            $id         = $selCatFaq->id;
            $type       = $selCatFaq->type;
            $consulting = Consulting::find()->where( [ 'slug' => $type ] )->one();
        }

        $db             = new Connection( Yii::$app->db );
        $categories_faq = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `faq` WHERE cat_id = category_faq.id) AS memberCount FROM `category_faq` as category_faq WHERE category_faq.type = '$consulting->slug'
        " )->queryAll();

        $allCat_faq = \frontend\modules\consulting\models\CategoryFaq::getChildCategoriesById( $id );
        $query      = Faq::find()->where( [
            'cat_id' => $allCat_faq,
            'type'   => $type
        ] )->orderBy( 'id DESC' );

        $cat_faq = CategoryFaq::find()->where( [ 'id' => $id ] )->one()->title;

        if ( ! $cat_faq ) {
            $cat_faq = 'Вопрос/Ответ';
        }
        $dataProvider = new SqlDataProvider( [
            'sql'        => $query->createCommand()->rawSql,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                // количество пунктов на странице
                'pageSize' => 10,
            ]
        ] );

        return $this->render( 'consulting_faq', [
            'consulting'     => $consulting,
            'categories_faq' => $categories_faq,
            'cat_faq'        => $cat_faq,
            'dataProvider'   => $dataProvider,
            'active_id'      => $id,
            'url'            => "/consulting/consulting/faq",
        ] );
    }

    public function actionFaqv() {

        $request    = Yii::$app->request;
        $faq_slug   = $request->get()['faqslug'];
        $consulting = $request->get()['slug'];
        if ( $request->get()['faqslug'] ) {

            $faq            = Faq::find()->where( [ 'slug' => $faq_slug ] )->one();
            $category_id    = $faq->cat_id;
            $category       = CategoryFaq::find()->where( [ 'id' => $category_id ] )->one();
            $consulting     = Consulting::find()->where( [ 'slug' => $consulting ] )->one();
            $db             = new Connection( Yii::$app->db );
            $categories_faq = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `faq` WHERE cat_id = category_faq.id) AS memberCount FROM `category_faq` as category_faq WHERE category_faq.type = '$consulting->slug'
        " )->queryAll();
            $cat_faq        = $category->title;
        }

        return $this->render( 'consulting_faq_item', [
            'consulting'     => $consulting,
            'categories_faq' => $categories_faq,
            'active_id'      => $category_id,
            'url'            => '/consulting/consulting/faq',
            'cat_faq'        => $cat_faq,
            'faq'            => $faq,
            'category'       => $category,
        ] );

    }

    public function actionPosts(){
        $request = Yii::$app->request;

        if ( $request->get()['id'] ) {
            $id         = $request->get()['id'];
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        } elseif ( $request->get()['slug'] ) {
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        } elseif ( $request->get()['slugcategory'] ) {
            $selCatPosts  = CategoryPostsConsulting::find()->where( [ 'slug' => $request->get()['slugcategory'] ] )->one();
            $id         = $selCatPosts->id;
            $type       = $selCatPosts->type;
            $consulting = Consulting::find()->where( [ 'slug' => $type ] )->one();
        }

        $db             = new Connection( Yii::$app->db );
        $categories_posts = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `posts_consulting` WHERE cat_id = category_posts_consulting.id) AS memberCount FROM `category_posts_consulting` as category_posts_consulting WHERE category_posts_consulting.type = '$consulting->slug'
        " )->queryAll();

        $allCat_posts = \frontend\modules\consulting\models\CategoryFaq::getChildCategoriesById( $id );
        $query      = PostsConsulting::find()->where( [
            'cat_id' => $allCat_posts,
            'type'   => $type
        ] )->orderBy( 'id DESC' );

        $cat_posts = CategoryFaq::find()->where( [ 'id' => $id ] )->one()->title;

        if ( ! $cat_posts ) {
            $cat_posts = 'Статьи';
        }
        $dataProvider = new SqlDataProvider( [
            'sql'        => $query->createCommand()->rawSql,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                // количество пунктов на странице
                'pageSize' => 10,
            ]
        ] );

        return $this->render( 'consulting_posts', [
            'consulting'     => $consulting,
            'categories_posts' => $categories_posts,
            'cat_posts'        => $cat_posts,
            'dataProvider'   => $dataProvider,
            'active_id'      => $id,
            'url'            => "/consulting/consulting/posts",
        ] );
    }

    public function actionPostsv() {

        $request    = Yii::$app->request;
        $post_slug   = $request->get()['postslug'];
        $consulting = $request->get()['slug'];
        if ( $request->get()['postslug'] ) {

            $posts          = PostsConsulting::find()->where( [ 'slug' => $post_slug ] )->one();
            $category_id    = $posts->cat_id;
            $category       = CategoryPostsConsulting::find()->where( [ 'id' => $category_id ] )->one();
            $consulting     = Consulting::find()->where( [ 'slug' => $consulting ] )->one();
            $db             = new Connection( Yii::$app->db );
            $categories_posts = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `posts_consulting` WHERE cat_id = category_posts_consulting.id) AS memberCount FROM `category_posts_consulting` as category_posts_consulting WHERE category_posts_consulting.type = '$consulting->slug'
        " )->queryAll();
            $cat_faq        = $category->title;
        }
        return $this->render( 'consulting_posts_item', [
            'consulting'     => $consulting,
            'categories_posts' => $categories_posts,
            'active_id'      => $category_id,
            'url'            => '/consulting/consulting/posts',
            'cat_posts'        => $cat_faq,
            'posts'            => $posts,
            'category'       => $category,
        ] );

    }

}
