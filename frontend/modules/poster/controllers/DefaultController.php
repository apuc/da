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
class DefaultController extends Controller {
    public $layout = 'portal_page';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render( 'index' );
    }

    public function actionView( $slug ) {
        $poster = Poster::find()->where( [ 'slug' => $slug ] )->one();

        if ( empty( $poster ) ) {
            return $this->redirect( [ 'site/error' ] );
        }

        $poster->updateAllCounters( [ 'views' => 1 ], [ 'id' => $poster->id ] );

        $cats_posters_ids = ArrayHelper::getColumn( CategoryPosterRelations::find()->where( [ 'poster_id' => $poster->id ] )->select( 'cat_id' )->asArray()->all(), 'cat_id' );
        $cats_posters     = ArrayHelper::getColumn( CategoryPosterRelations::find()->where( [ 'cat_id' => $cats_posters_ids ] )->select( 'poster_id' )->asArray()->all(), 'poster_id' );

        $related_posters = Poster::find()->where( [ 'id' => $cats_posters ] )->andWhere( [
            '!=',
            'id',
            $poster->id
        ] )->andWhere( [ '>', 'dt_event', time() ] )->orderBy( [ 'rand()' => SORT_DESC ] )->limit( 6 )->all();

        $most_popular_posters = Poster::find()->andWhere( [ '>', 'dt_event', time() ] )->andWhere( [
            '!=',
            'id',
            $poster->id
        ] )->orderBy( 'views DESC' )->limit( 6 )->all();

        $count_likes   = count( Likes::find()
                                     ->where( [ 'post_type' => 'posters', 'post_id' => $poster->id ] )
                                     ->all() );
        $user_set_like = Likes::find()
                              ->where( [
                                  'post_type' => 'posters',
                                  'user_id'   => Yii::$app->user->id,
                                  'post_id'   => $poster->id,
                              ] )
                              ->one();

        return $this->render( 'view', [
            'poster'               => $poster,
            'related_posters'      => $related_posters,
            'most_popular_posters' => $most_popular_posters,
            'count_likes'          => $count_likes,
            'user_set_like'        => $user_set_like,
        ] );
    }

    public function actionCategory() {
        $query        = \common\models\db\Poster::find()->orderBy( 'dt_event_end' )->andWhere( [
            '>',
            'dt_event_end',
            time()
        ] );
        $dataProvider = new SqlDataProvider( [
            'sql'        => $query->createCommand()->rawSql,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ] );

        return $this->render( 'category', [
            'category'     => CategoryPoster::find()->orderBy( 'id DESC' )->all(),
            'dataProvider' => $dataProvider,
            'meta_title'   => KeyValue::findOne( [ 'key' => 'poster_page_meta_title' ] )->value,
            'meta_descr'   => KeyValue::findOne( [ 'key' => 'poster_page_meta_descr' ] )->value,
        ] );
    }

    public function actionArchive_category() {
        $query        = \common\models\db\Poster::find()->orderBy( 'dt_event DESC' );
        $dataProvider = new SqlDataProvider( [
            'sql'        => $query->createCommand()->rawSql,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ] );

        return $this->render( 'category', [
            'category'     => CategoryPoster::find()->orderBy( 'id DESC' )->all(),
            'dataProvider' => $dataProvider,
        ] );
    }

    public function actionSingle_category( $slug ) {
        $cat   = CategoryPoster::find()->where( [ 'slug' => $slug ] )->one();
        $query = CategoryPosterRelations::find()
                                        ->leftJoin( 'poster', '`category_poster_relations`.`poster_id` = `poster`.`id`' )
                                        ->orderBy( 'dt_event' )
                                        ->where( [ 'cat_id' => $cat->id ] )
                                        ->andWhere( [ '>', 'dt_event_end', time() ] )
                                        ->with( 'poster' );

        $dataProvider = new ActiveDataProvider( [
            'query'      => $query,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ] );

        return $this->render( 'category', [
            'category'     => CategoryPoster::find()->orderBy( 'id DESC' )->all(),
            'dataProvider' => $dataProvider,
        ] );
    }

    public function actionSingle_archive_category( $slug ) {
        $cat   = CategoryPoster::find()->where( [ 'slug' => $slug ] )->one();
        $query = CategoryPosterRelations::find()
                                        ->leftJoin( 'poster', '`category_poster_relations`.`poster_id` = `poster`.`id`' )
                                        ->orderBy( 'dt_event DESC' )
                                        ->where( [ 'cat_id' => $cat->id ] )
                                        ->with( 'poster' );

        $dataProvider = new ActiveDataProvider( [
            'query'      => $query,
            'totalCount' => (int) $query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ] );

        return $this->render( 'category', [
            'category'     => CategoryPoster::find()->orderBy( 'id DESC' )->all(),
            'dataProvider' => $dataProvider,
        ] );
    }

    public static function actionUpdposterdt_event() {

        $posters = Poster::find()->all();
        foreach ( $posters as $k ) {
            if ( $k->dt_event == 0 ) {
                Poster::updateAll( [ 'dt_event' => $k->dt_add ], [ 'id' => $k->id ] );
            }
        }

    }

    public static function actionUpdposterdt_event_end() {

        $posters = Poster::find()->all();
        foreach ( $posters as $k ) {
            if ( $k->dt_event_end == 0 ) {
                Poster::updateAll( [ 'dt_event_end' => $k->dt_event ], [ 'id' => $k->id ] );
            }
        }

    }

    public function actionPoster_rss() {
        $dataProvider = new ActiveDataProvider( [
            'query'      => Poster::find()
                                  ->where( [ 'rss' => 1, 'status' => 0 ] )
                                  ->limit( 20 )
                                  ->orderBy( 'dt_add DESC' ),
            'pagination' => [
                'pageSize' => 10
            ],
        ] );

        $response = Yii::$app->getResponse();
        $headers  = $response->getHeaders();

        $headers->set( 'Content-Type', 'application/rss+xml; charset=utf-8' );

        echo \Zelenin\yii\extensions\Rss\RssView::widget( [
            'dataProvider' => $dataProvider,
            'channel'      => [
                'title'       => function ( $widget, \Zelenin\Feed $feed ) {
                    $feed->addChannelTitle( KeyValue::findOne( [ 'key' => 'rss_poster_title' ] )->value );
                },
                'link'        => Url::toRoute( '/', true ),
                'description' => KeyValue::findOne( [ 'key' => 'rss_poster_desc' ] )->value,
                'language'    => function ( $widget, \Zelenin\Feed $feed ) {
                    return Yii::$app->language;
                },
                'image'       => function ( $widget, \Zelenin\Feed $feed ) {
                    $feed->addChannelImage( Yii::$app->request->hostInfo . '/theme/portal-donbassa/img/logo3.png', Yii::$app->request->hostInfo, 31, 31, 'DA logo' );
                },
            ],
            'items'        => [
                'title'       => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return $model->title;
                },
                'category'    => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    $cats = CategoryPosterRelations::find()
                                                   ->where( [ 'poster_id' => $model->id ] )
                                                   ->with( 'category_poster' )
                                                   ->all();
                    foreach ( $cats as $cat ) {
                        $feed->addItemCategory( $cat->category_poster->title );
                    }
                },
                'enclosure'   => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    if ( ! empty( $model->photo ) ) {
                        $feed->addItemEnclosure( Yii::$app->request->hostInfo . $model->photo, 123, 'image/jpeg' );
                    }
                },
                'description' => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return StringHelper::truncateWords( strip_tags( $model->descr ), 50 );
                },
                'link'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return Url::to( [ '/poster/' . $model->slug ], true );
                },
                'guid'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    $date = date( DATE_RSS, $model->dt_add );

                    return Url::to( [
                        '/poster/' . $model->slug
                    ], true ) . ' ' . $date;
                },
                'pubDate'     => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $date = date( DATE_RSS, $model->dt_add );

                    return $date;

                }
            ]
        ] );
    }
}
