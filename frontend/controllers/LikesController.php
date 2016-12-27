<?php

namespace frontend\controllers;

use common\classes\Debug;
use common\models\db\Likes;
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
}