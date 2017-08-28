<?php

namespace frontend\modules\rss\controllers;

use backend\modules\vk\models\VkStream;
use common\classes\Debug;
use common\models\db\CategoryNewsRelations;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use common\models\db\News;
use common\models\db\Poster;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Default controller for the `rss` module
 */
class RssController extends Controller {

    public function actionNews_rss() {
        $dataProvider = new ActiveDataProvider( [
            'query'      => News::find()
                                ->where( [ 'rss' => 1, 'status' => 0 ] )
                                ->limit( 20 )
                                ->orderBy( 'dt_public DESC' ),
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
                    $feed->addChannelTitle( KeyValue::findOne( [ 'key' => 'rss_news_title' ] )->value );
                },
//                'link'        => Url::toRoute( '/', true ),
                'link'        => Url::toRoute( '/' . 'rss/news.xml', true ),
                'description' => KeyValue::findOne( [ 'key' => 'rss_news_desc' ] )->value,
                'language'    => function ( $widget, \Zelenin\Feed $feed ) {
                    return Yii::$app->language;
                },
                'image'       => function ( $widget, \Zelenin\Feed $feed ) {
                    $feed->addChannelImage( Yii::$app->request->hostInfo . '/theme/portal-donbassa/img/logo3.png', Url::toRoute( '/' . 'rss/news.xml', true ), 31, 31, 'DA logo' );

                },
            ],
            'items'        => [
                'title'       => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return $model->title;
                },
                'category'    => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    $cats = CategoryNewsRelations::find()
                                                 ->where( [ 'new_id' => $model->id ] )
                                                 ->with( 'cat' )
                                                 ->all();
                    foreach ( $cats as $cat ) {
                        $feed->addItemCategory( $cat->cat->title );
                    }
                },
                'enclosure'   => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    if ( ! empty( $model->photo ) ) {
                        $feed->addItemEnclosure( Yii::$app->request->hostInfo . $model->photo, 123, 'image/jpeg' );
                    }
                },
                'description' => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return StringHelper::truncateWords( strip_tags( $model->content ), 50 );
                },
                'link'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return Url::to( [ '/news/' . $model->slug ], true );
                },
                'guid'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    //$date = date( DATE_RSS, $model->dt_public );

                    return Url::to( [
                        '/news/' . $model->slug
                    ], true );
                    //return $model->slug;
                },
                'pubDate'     => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $date = date( DATE_RSS, $model->dt_public );

                    return $date;

                },
                'save'        => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $feed->save( 'rss/news.xml' );

                },

            ]
        ] );
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
//                'link'        => Url::toRoute( '/', true ),
                'link'        => Url::toRoute( '/' . 'rss/poster.xml', true ),
                'description' => KeyValue::findOne( [ 'key' => 'rss_poster_desc' ] )->value,
                'language'    => function ( $widget, \Zelenin\Feed $feed ) {
                    return Yii::$app->language;
                },
                'image'       => function ( $widget, \Zelenin\Feed $feed ) {
                    $feed->addChannelImage( Yii::$app->request->hostInfo . '/theme/portal-donbassa/img/logo3.png', Url::toRoute( '/' . 'rss/poster.xml', true ), 31, 31, 'DA logo' );
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

                    return Url::to( [
                        '/poster/' . $model->slug
                    ], true );
                },
                'pubDate'     => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $date = date( DATE_RSS, $model->dt_add );

                    return $date;

                },
                'save'        => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $feed->save( 'rss/poster.xml' );


                },
            ]
        ] );
    }

    public function actionStream_rss() {
        $dataProvider = new ActiveDataProvider( [
            'query'      => VkStream::find()
                ->where( [ 'rss' => 1, 'status' => 1 ] )
                ->andWhere([ '<' , 'dt_publish', time()])
                ->andWhere('`id` NOT IN (SELECT `post_id` FROM `vk_gif`)' )
                ->limit( 20 )
                ->orderBy( 'dt_publish DESC' ),
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
                    $feed->addChannelTitle( KeyValue::findOne( [ 'key' => 'rss_stream_title' ] )->value );
                },
//                'link'        => Url::toRoute( '/', true ),
                'link'        => Url::toRoute( '/' . 'rss/stream.xml', true ),
                'description' => KeyValue::findOne( [ 'key' => 'rss_stream_desc' ] )->value,
                'language'    => function ( $widget, \Zelenin\Feed $feed ) {
                    return Yii::$app->language;
                },
                'image'       => function ( $widget, \Zelenin\Feed $feed ) {
                    $feed->addChannelImage( Yii::$app->request->hostInfo . '/theme/portal-donbassa/img/logo3.png', Url::toRoute( '/' . 'rss/stream.xml', true ), 31, 31, 'DA logo' );

                },
            ],
            'items'        => [
                'title'       => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return $model->title;
                },
                /*'category'    => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    $cats = CategoryNewsRelations::find()
                        ->where( [ 'new_id' => $model->id ] )
                        ->with( 'cat' )
                        ->all();
                    foreach ( $cats as $cat ) {
                        $feed->addItemCategory( $cat->cat->title );
                    }
                },*/
                'enclosure'   => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    if ( ! empty( $model->getLargePhoto() ) ) {
                        $feed->addItemEnclosure( $model->getLargePhoto(), 123, 'image/jpeg' );
                    }
                },
                'description' => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return StringHelper::truncateWords( strip_tags( $model->text ), 50 );
                },
                'link'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return Url::to( [ '/stream/' . $model->slug ], true );
                },
                'guid'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    //$date = date( DATE_RSS, $model->dt_public );

                    return Url::to( [
                        '/stream/' . $model->slug
                    ], true );
                    //return $model->slug;
                },
                'pubDate'     => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $date = date( DATE_RSS, $model->dt_publish );

                    return $date;

                },
                'save'        => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $feed->save( 'rss/stream.xml' );

                },

            ]
        ] );
    }

    public function actionStreamGif_rss() {
        $dataProvider = new ActiveDataProvider( [
            'query'      => VkStream::find()
                ->where( [ 'rss' => 1, 'status' => 1 ] )
                ->andWhere([ '<' , 'dt_publish', time()])
                ->andWhere('`id` IN (SELECT `post_id` FROM `vk_gif`)' )
                ->with('gif')
                ->limit( 20 )
                ->orderBy( 'dt_publish DESC' ),
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
                    $feed->addChannelTitle( KeyValue::findOne( [ 'key' => 'rss_stream_title' ] )->value );
                },
//                'link'        => Url::toRoute( '/', true ),
                'link'        => Url::toRoute( '/' . 'rss/stream_gif.xml', true ),
                'description' => KeyValue::findOne( [ 'key' => 'rss_stream_desc' ] )->value,
                'language'    => function ( $widget, \Zelenin\Feed $feed ) {
                    return Yii::$app->language;
                },
                'image'       => function ( $widget, \Zelenin\Feed $feed ) {
                    $feed->addChannelImage( Yii::$app->request->hostInfo . '/theme/portal-donbassa/img/logo3.png', Url::toRoute( '/' . 'rss/stream.xml', true ), 31, 31, 'DA logo' );

                },
            ],
            'items'        => [
                'title'       => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return $model->title;
                },
                'enclosure'   => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    if ( ! empty( $model->gif->gif_link ) ) {
                        $feed->addItemEnclosure( $model->gif->gif_link, 123, 'image/jpeg' );
                    }
                },
                'description' => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return StringHelper::truncateWords( strip_tags( $model->text ), 50 );
                },
                'link'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    return Url::to( [ '/stream/' . $model->slug ], true );
                },
                'guid'        => function ( $model, $widget, \Zelenin\Feed $feed ) {
                    //$date = date( DATE_RSS, $model->dt_public );

                    return Url::to( [
                        '/stream/' . $model->slug
                    ], true );
                    //return $model->slug;
                },
                'pubDate'     => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $date = date( DATE_RSS, $model->dt_publish );

                    return $date;

                },
                'save'        => function ( $model, $widget, \Zelenin\Feed $feed ) {

                    $feed->save( 'rss/stream_gif.xml' );

                },

            ]
        ] );
    }

}
