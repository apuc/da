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
use common\models\db\PostsDigest;
use frontend\modules\consulting\models\CategoryPosts;
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

        $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        if ( empty( $consulting ) ) {
            return $this->redirect( [ 'site/error' ] );
        }
        if ( empty( $consulting->about_company ) ) {
            if ( ! empty( $consulting->documents ) ) {
                return $this->redirect( [ '/consulting/consulting/documents', 'slug' => $request->get( 'slug' ) ] );
            } elseif ( ! empty( $consulting->posts ) ) {
                return $this->redirect( [ '/consulting/consulting/posts', 'slug' => $request->get( 'slug' ) ] );
            } elseif ( ! empty( $consulting->faq ) ) {
                return $this->redirect( [ '/consulting/consulting/faq', 'slug' => $request->get( 'slug' ) ] );
            } else {
                return $this->redirect( [ '/consulting/consulting/index' ] );
            }
        }

        $company        = Company::find()->where( [ 'id' => $consulting->company_id ] )->one();
        $db             = new Connection( Yii::$app->db );
        $categories_faq = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `faq` WHERE cat_id = category_faq.id) AS memberCount FROM `category_faq` as category_faq WHERE category_faq.type = '$consulting->slug'
        ORDER BY category_faq.sort_order, category_faq.dt_add" )->queryAll();

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
        if ( empty( $consulting ) ) {
            return $this->redirect( [ 'site/error' ] );
        }
        if ( ! empty( $id ) ) {
            $cur_cat    = CategoryFaq::find()->where( [ 'id' => $id ] )->one();
            $meta_title = ( empty( $cur_cat->meta_title ) ) ? $cur_cat->title : $cur_cat->meta_title;
            $meta_descr = $cur_cat->meta_descr;
        } else {
            $meta_title = ( empty( $consulting->meta_title ) ) ? $consulting->title : $consulting->meta_title;
            $meta_descr = $consulting->meta_descr;
        }

        $db             = new Connection( Yii::$app->db );
        $categories_faq = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `faq` WHERE cat_id = category_faq.id) AS memberCount FROM `category_faq` as category_faq WHERE category_faq.type = '$consulting->slug'
        ORDER BY category_faq.sort_order, category_faq.dt_add" )->queryAll();

        $allCat_faq = \frontend\modules\consulting\models\CategoryFaq::getChildCategoriesById( $id );
        $query      = Faq::find()->where( [
            'cat_id' => $allCat_faq,
            'type'   => $type
        ] )->orderBy( 'sort_order, dt_add' );

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
            'meta_title'     => $meta_title,
            'meta_descr'     => $meta_descr,
        ] );
    }

    public function actionFaqv() {

        $request    = Yii::$app->request;
        $faq_slug   = $request->get()['faqslug'];
        $consulting = $request->get()['slug'];

        if ( $request->get()['faqslug'] ) {

            $faq = Faq::find()->where( [ 'slug' => $faq_slug ] )->one();

            $category_id    = $faq->cat_id;
            $category       = CategoryFaq::find()->where( [ 'id' => $category_id ] )->one();
            $consulting     = Consulting::find()->where( [ 'slug' => $consulting ] )->one();
            $db             = new Connection( Yii::$app->db );
            $categories_faq = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `faq` WHERE cat_id = category_faq.id) AS memberCount FROM `category_faq` as category_faq WHERE category_faq.type = '$consulting->slug'
        ORDER BY category_faq.sort_order, category_faq.dt_add" )->queryAll();
            $cat_faq        = $category->title;
            if ( empty( $faq ) || empty( $consulting ) ) {
                return $this->redirect( [ 'site/error' ] );
            }
            $faq->updateAllCounters( [ 'views' => 1 ], [ 'id' => $faq->id ] );
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

    public function actionPosts() {
        $request = Yii::$app->request;

        if ( $request->get()['id'] ) {
            $id         = $request->get()['id'];
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        } elseif ( $request->get()['slug'] ) {
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        } elseif ( $request->get()['slugcategory'] ) {
            $selCatPosts = CategoryPostsConsulting::find()->where( [ 'slug' => $request->get()['slugcategory'] ] )->one();
            $id          = $selCatPosts->id;
            $type        = $selCatPosts->type;
            $consulting  = Consulting::find()->where( [ 'slug' => $type ] )->one();
        }
        if ( empty( $consulting ) ) {
            return $this->redirect( [ 'site/error' ] );
        }
        if ( ! empty( $id ) ) {
            $cur_cat    = CategoryPostsConsulting::find()->where( [ 'id' => $id ] )->one();
            $meta_title = ( empty( $cur_cat->meta_title ) ) ? $cur_cat->title : $cur_cat->meta_title;
            $meta_descr = $cur_cat->meta_descr;
        } else {
            $meta_title = ( empty( $consulting->meta_title ) ) ? $consulting->title : $consulting->meta_title;
            $meta_descr = $consulting->meta_descr;
        }

        $db               = new Connection( Yii::$app->db );
        $categories_posts = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `posts_consulting` WHERE cat_id = category_posts_consulting.id) AS memberCount FROM `category_posts_consulting` as category_posts_consulting WHERE category_posts_consulting.type = '$consulting->slug'
        ORDER BY category_posts_consulting.sort_order, category_posts_consulting.dt_add " )->queryAll();

        $allCat_posts = \frontend\modules\consulting\models\CategoryPosts::getChildCategoriesById( $id );
        $query        = PostsConsulting::find()->where( [
            'cat_id' => $allCat_posts,
            'type'   => $type
        ] )->orderBy( 'sort_order, dt_add' );

        $cat_posts = CategoryPostsConsulting::find()->where( [ 'id' => $id ] )->one()->title;

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
            'consulting'       => $consulting,
            'categories_posts' => $categories_posts,
            'cat_posts'        => $cat_posts,
            'dataProvider'     => $dataProvider,
            'active_id'        => $id,
            'url'              => "/consulting/consulting/posts",
            'meta_title'       => $meta_title,
            'meta_descr'       => $meta_descr,
        ] );
    }

    public function actionPostsv() {

        $request   = Yii::$app->request;
        $post_slug = $request->get()['postslug'];

        $consulting = $request->get()['slug'];
        if ( $request->get()['postslug'] ) {
            $posts            = PostsConsulting::find()->where( [ 'slug' => $post_slug ] )->one();
            $category_id      = $posts->cat_id;
            $category         = CategoryPostsConsulting::find()->where( [ 'id' => $category_id ] )->one();
            $consulting       = Consulting::find()->where( [ 'slug' => $consulting ] )->one();
            $db               = new Connection( Yii::$app->db );
            $categories_posts = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `posts_consulting` WHERE cat_id = category_posts_consulting.id) AS memberCount FROM `category_posts_consulting` as category_posts_consulting WHERE category_posts_consulting.type = '$consulting->slug'
        ORDER BY category_posts_consulting.sort_order, category_posts_consulting.dt_add " )->queryAll();
            $cat_post         = $category->title;
            if ( empty( $consulting ) || empty( $posts ) ) {
                return $this->redirect( [ 'site/error' ] );
            }
            $posts->updateAllCounters( [ 'views' => 1 ], [ 'id' => $posts->id ] );
        }

        return $this->render( 'consulting_posts_item', [
            'consulting'       => $consulting,
            'categories_posts' => $categories_posts,
            'active_id'        => $category_id,
            'url'              => '/consulting/consulting/posts',
            'cat_posts'        => $cat_post,
            'posts'            => $posts,
            'category'         => $category,
        ] );

    }

    public function actionDocuments() {
        $request = Yii::$app->request;

        if ( $request->get()['id'] ) {
            $id         = $request->get()['id'];
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
        } elseif ( $request->get()['slug'] ) {
            $type       = $request->get( 'slug' );
            $consulting = Consulting::find()->where( [ 'slug' => $request->get( 'slug' ) ] )->one();
            
        } elseif ( $request->get()['slugcategory'] ) {
            $selCatPosts = CategoryPostsDigest::find()->where( [ 'slug' => $request->get()['slugcategory'] ] )->one();
            $id          = $selCatPosts->id;
            $type        = $selCatPosts->type;
            $consulting  = Consulting::find()->where( [ 'slug' => $type ] )->one();
        }

        if ( ! empty( $id ) ) {
            $cur_cat    = CategoryPostsDigest::find()->where( [ 'id' => $id ] )->one();
            $meta_title = ( empty( $cur_cat->meta_title ) ) ? $cur_cat->title : $cur_cat->meta_title;
            $meta_descr = $cur_cat->meta_descr;
        } else {
            $meta_title = ( empty( $consulting->meta_title ) ) ? $consulting->title : $consulting->meta_title;
            $meta_descr = $consulting->meta_descr;
        }
        if ( empty( $consulting ) ) {
            return $this->redirect( [ 'site/error' ] );
        }

        // $db = new Connection( Yii::$app->db );
//        $categories_posts = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `posts_digest` WHERE cat_id = category_posts_digest.id) AS memberCount FROM `category_posts_digest` as category_posts_digest WHERE category_posts_digest.type = '$consulting->slug'
//        " )->queryAll();
        $categories_posts = CategoryPostsDigest::find()->where( [ 'type' => $consulting->slug ] )->orderBy( 'sort_order, dt_add' )->all();

        $allCat_posts = \frontend\modules\consulting\models\CategoryDigest::getChildCategoriesById( $id );
        $query        = PostsDigest::find()->where( [
            //  'cat_id' => $allCat_posts,
            'type' => $type
        ] )->rightJoin( 'category_posts_digest_relations', '`posts_digest`.id = `category_posts_digest_relations`.posts_digest_id' )->where( [ '`category_posts_digest_relations`.cat_id' => $allCat_posts ] )->orderBy( 'sort_order, dt_add' );
        $cat_posts    = CategoryPostsDigest::find()->where( [ 'id' => $id ] )->one()->title;

        if ( ! $cat_posts ) {
            $cat_posts = $consulting->title_digest;
        }
        $dataProvider = new SqlDataProvider( [
            'sql'        => $query->createCommand()->rawSql,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                // количество пунктов на странице
                'pageSize' => 10,
            ]
        ] );

        return $this->render( 'consulting_digest', [
            'consulting'       => $consulting,
            'categories_posts' => $categories_posts,
            'cat_posts'        => $cat_posts,
            'dataProvider'     => $dataProvider,
            'active_id'        => $id,
            'url'              => "/consulting/consulting/documents",
            'meta_title'       => $meta_title,
            'meta_descr'       => $meta_descr,
          
        ] );
    }

    public function actionDocumentsv() {

        $request    = Yii::$app->request;
        $post_slug  = $request->get()['postslug'];
        $consulting = $request->get()['slug'];
        if ( $request->get()['postslug'] ) {

            $posts            = PostsDigest::find()->where( [ 'slug' => $post_slug ] )->one();
            $category_id      = $request->get()['catslug'];
            $category         = CategoryPostsDigest::find()->where( [ 'slug' => $category_id ] )->one();
            $consulting       = Consulting::find()->where( [ 'slug' => $consulting ] )->one();
            $db               = new Connection( Yii::$app->db );
            $categories_posts = $db->createCommand( "SELECT *, (SELECT COUNT(*) FROM `posts_digest`) AS memberCount FROM `category_posts_digest` as category_posts_digest WHERE category_posts_digest.type = '$consulting->slug'
        ORDER BY category_posts_digest.sort_order, category_posts_digest.dt_add " )->queryAll();
            $cat_digest       = $category->title;
            if ( empty( $consulting ) || empty( $posts ) ) {
                return $this->redirect( [ 'site/error' ] );
            }
            $posts->updateAllCounters( [ 'views' => 1 ], [ 'id' => $posts->id ] );
        }

        return $this->render( 'consulting_digest_item', [
            'consulting'       => $consulting,
            'categories_posts' => $categories_posts,
            'active_id'        => $category->id,
            'url'              => '/consulting/consulting/documents',
            'cat_posts'        => $cat_digest,
            'posts'            => $posts,
            'category'         => $category,
        ] );

    }

}
