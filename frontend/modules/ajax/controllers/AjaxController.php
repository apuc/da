<?php

namespace frontend\modules\ajax\controllers;

use common\classes\Debug;
use common\models\db\Answers;
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
            $user        = Yii::$app->user->id;
            $answer      = PossibleAnswers::find()
                                          ->where( [
                                              'id' => $_POST['answer']
                                          ] )
                                          ->one();
            $already_poll = Answers::find()
                                  ->where( [
                                      'user_id'     => $user,
                                      'question_id' => $answer->question
                                  ] )
                                  ->one();
            if (empty($already_poll)) {

                $vote = new Answers();
                $vote->question_id = $answer->question;
                $vote->possible_answers_id = $answer->id;
                $vote->user_id = $user;
                $vote->dt_add = time();

                $vote->save();
                
                echo Poll::widget();
                
            }
        }
    }
}
