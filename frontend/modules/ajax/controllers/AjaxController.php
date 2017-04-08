<?php

namespace frontend\modules\ajax\controllers;

use common\classes\Debug;
use common\models\db\Answers;
use common\models\db\Comments;
use common\models\db\PossibleAnswers;
use common\models\db\Question;
use frontend\widgets\Poll;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `ajax` module
 */
class AjaxController extends Controller {

    public function actionSend_poll() {
        if ( $_POST ) {
            $user = 0;
            $user_ip = Yii::$app->request->userIP;
            if ( ! Yii::$app->user->isGuest ) {
                $user = Yii::$app->user->id;
            }

            $answer       = PossibleAnswers::find()
                                           ->where( [
                                               'id' => $_POST['answer']
                                           ] )
                                           ->one();
            $already_poll = Answers::find()
                                   ->where( [
                                       'user_ip'     => $user_ip,
                                       'question_id' => $answer->question
                                   ] )
                                   ->one();
            if ( empty( $already_poll ) ) {

                $vote                      = new Answers();
                $vote->question_id         = $answer->question;
                $vote->possible_answers_id = $answer->id;
                $vote->user_id             = $user;
                $vote->user_ip            = $user_ip;
                $vote->dt_add              = time();

                $vote->save();

                echo Poll::widget();

            }
        }
    }

    public function actionGet_more_comments() {
        if ( $_POST ) {
            $request  = Yii::$app->request->post();
            $comments = Comments::find()
                                ->where( [
                                    'post_type' => $request['post_type'],
                                    'post_id'   => $request['post_id'],
                                ] )
                                ->andWhere( [ '<', 'dt_add', $request['date'] ] )
                                ->orderBy( 'dt_add DESC' )
                                ->offset( $request['count'] )
                                ->limit( $request['limit'] )
                                ->all();


            echo $this->renderPartial( '_comments',
                [ 'comments' => $comments ]
            );
        }
    }

    public function actionAdd_comment() {
        if ( $_POST ) {

            $request                = Yii::$app->request->post();
            $current_user           = Yii::$app->user->id;
            $new_comment            = new Comments();
            $new_comment->post_type = $request['post_type'];
            $new_comment->post_id   = $request['post_id'];
            $new_comment->user_id   = $current_user;
            $new_comment->content   = $request['content'];
            $new_comment->dt_add    = time();

            $new_comment->save();

            // return $this->redirect();

//            echo $this->renderPartial( '_comments',
//                [
//                    'comments' => Comments::find()
//                                          ->where( [ 'id' => $new_comment->id ] )
//                                          ->limit( 1 )
//                                          ->one()
//                ]
//            );

        }
    }
}
