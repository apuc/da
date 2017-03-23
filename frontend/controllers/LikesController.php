<?php

namespace frontend\controllers;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\Likes;
use common\models\db\News;
use Yii;
use yii\web\Controller;

class LikesController extends Controller {

    public function actionLike() {

        if ( Yii::$app->user->isGuest ) {
            return $this->redirect( '/user/login' );
        }

        $request = Yii::$app->request->post();

        $set_like = Likes::find()
                         ->where( [
                             'post_type' => $request['post_type'],
                             'post_id'   => $request['post_id'],
                             'user_id'   => Yii::$app->user->id,
                         ] )
                         ->one();

        if ( empty( $set_like ) ) {

            $new_like            = new Likes();
            $new_like->post_type = $request['post_type'];
            $new_like->post_id   = $request['post_id'];
            $new_like->user_id   = Yii::$app->user->id;
            $new_like->dt_add    = time();

            $new_like->save();

        } else {

            Likes::deleteAll( [ 'id' => $set_like->id ] );

        }
        echo count( Likes::find()
                         ->where( [ 'post_type' => $request['post_type'], 'post_id' => $request['post_id'] ] )
                         ->all() );
    }

    public static function actionReplace_space() {
        $words = array(
            'Инструкция по заполнению декларации',
            'Приказы МДС',
            'Заполнение книги продаж',
            'Основания досмотра',
            'документы для скачивания',
            'Личностный рост',
            'Международные новости',
            'Новости города',
            'Налоги и хозяйственная деятельность',
            'Политические новости',
            'Репортажи и интервью',
            'Социальные новости',
            'Спортивные новости',
            'Формы и бланки отчетности',
            'Использование воды',
            'КУРО И РРО',
            'Налог на прибыль',
            'Налог с оборота',
            'Плата за землю',
            'Внешняя торговля товарами',
            'Внутренняя торговля',
            'Финансовая отчетность',
            'Упрощенный налог',
            'Экономические новости',
        );
        foreach ( $words as $word ):
            $new_word = str_replace( ' ', '_', $word );

            $news = News::find()->where( [ 'like', 'photo', '/' . $word . '/' ] )->all();

            foreach ( $news as $new ):
                $new->photo = str_replace( $word, $new_word, $new->photo );
                $new->content = str_replace( $word, $new_word, $new->content );
                $new->save();
            endforeach;

        $company = Company::find()->where([ 'like', 'photo', '/' . $word . '/' ])->all();

            foreach ( $company as $company_item ):
                $company_item->photo = str_replace( $word, $new_word, $company_item->photo );
                $company_item->content = str_replace( $word, $new_word, $company_item->content );
                $company_item->save();
            endforeach;


//        Debug::prn($news);
//            echo  $new_word. '<br>';


        endforeach;

    }

}