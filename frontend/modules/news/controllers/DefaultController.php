<?php

namespace frontend\modules\news\controllers;

use common\classes\Debug;
use common\models\db\CategoryNewsRelations;
use common\models\db\Lang;
use common\models\db\News;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller {
    public $layout = 'portal_page';

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        return $this->render( 'index', [
            'news' => News::find()->where( [ 'lang_id' => Lang::getCurrent()['id'] ] )->all(),
        ] );
    }

    public function actionView() {
        $new = News::find()->where( [ 'slug' => $_GET['slug'] ] )->one();
        if ( empty( $new ) ) {
            return $this->redirect( [ 'site/error' ] );
        }
        $new->updateAllCounters( [ 'views' => 1 ], [ 'id' => $new->id ] );

        $cats_news_ids = ArrayHelper::getColumn( CategoryNewsRelations::find()->where( [ 'new_id' => $new->id ] )->select( 'cat_id' )->asArray()->all(), 'cat_id' );
        $cats_news     = ArrayHelper::getColumn( CategoryNewsRelations::find()->where( [ 'cat_id' => $cats_news_ids ] )->select( 'new_id' )->asArray()->all(), 'new_id' );
        $related_news  = News::find()
                             ->where( [ 'id' => $cats_news, 'status' => 0 ] )
                             ->andWhere( [ '!=', 'id', $new->id ] )
                             ->andWhere( [ '>', 'dt_public', time() - 3600 * 24 * 14 ] )
                             ->orderBy( [ 'rand()' => SORT_DESC ] )
                             ->limit( 6 )
                             ->all();

        $most_popular_news = News::find()
                                 ->andWhere( [ '>', 'dt_public', time() - 3600 * 24 * 14 ] )
                                 ->andWhere( [ '!=', 'id', $new->id ] )
                                 ->andWhere( [ 'exclude_popular' => 0, 'status' => 0 ] )
                                 ->orderBy( 'views DESC' )
                                 ->limit( 6 )
                                 ->all();

        if ( ! empty( $new->content ) ) {
            return $this->render( 'view', [
                'news'              => $new,
                'related_news'      => $related_news,
                'most_popular_news' => $most_popular_news
            ] );
        } else {
            return $this->render( 'view_image', [
                'news'              => $new,
                'related_news'      => $related_news,
                'most_popular_news' => $most_popular_news
            ] );
        }
    }

    public function actionSet_dt_public() {
        $news = News::find()->where( [ 'dt_public' => null ] )->all();

        foreach ( $news as $new ) {
            News::updateAll( [ 'dt_public' => $new->dt_add ], [ 'id' => $new->id ] );
        }
    }
}
