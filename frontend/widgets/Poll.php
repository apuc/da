<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 29.09.2016
 * Time: 16:26
 */

namespace frontend\widgets;


use common\classes\Debug;
use common\models\db\Answers;
use common\models\db\KeyValue;
use common\models\db\PossibleAnswers;
use common\models\db\Question;
use common\models\db\TopCompany;
use Yii;
use yii\base\Widget;

class Poll extends Widget {

    public function run() {
        if ( ! Yii::$app->user->isGuest ) {
            $user           = Yii::$app->user->id;
            $active_poll_id = KeyValue::find()->where( [ 'key' => 'active_poll' ] )->one()->value;
            $question       = Question::find()->where( [ 'id' => $active_poll_id ] )->one();
            $already_poll   = Answers::find()
                                     ->where( [
                                         'user_id'     => $user,
                                         'question_id' => $question->id
                                     ] )
                                     ->one();
            if ( empty( $already_poll ) ) {

                $possible_answers = PossibleAnswers::find()
                                                   ->where( [ 'question' => $question->id ] )
                                                   ->all();

                return $this->render( 'poll', [
                    'question'         => $question,
                    'possible_answers' => $possible_answers,
                ] );

            } else {
                
                $answers = Answers::find()
                                  ->where( [ 'question_id' => $question->id ] )
                                  ->asArray()
                                  ->all();

                $sortedAnswers = [ ];

                foreach ( $answers as $answer ) {
                    $sortedAnswers[ $answer['possible_answers_id'] ] = $sortedAnswers[ $answer['possible_answers_id'] ] + 1;
                }
                $possible_answers = [ ];
                foreach ( $sortedAnswers as $key => $sortedAnswer ) {
                    $possible_answers[ $key ] = [
                        'val_per' => floor( $sortedAnswer / count( $answers ) * 100 ),
                        'val'     => $sortedAnswer,
                        'answer'  => PossibleAnswers::find()
                                                    ->where( [ 'id' => $key ] )
                                                    ->one()
                            ->title
                    ];
                }
                usort($possible_answers, function($a, $b){
                    return ($b['val_per'] - $a['val_per']);
                });
                return $this->render( 'poll-result', [

                    'question'         => $question,
                    'possible_answers' => $possible_answers,

                ] );

            }
        }
    }
}