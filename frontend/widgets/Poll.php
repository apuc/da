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
use yii\db\Connection;
use yii\helpers\ArrayHelper;

class Poll extends Widget {

    public function run() {

        $user_ip = Yii::$app->request->userIP;

        $active_poll_id = KeyValue::find()->where( [ 'key' => 'active_poll' ] )->one()->value;

        $question       = Question::find()->where( [ 'id' => $active_poll_id ] )->one();
        $already_poll   = Answers::find()
                                 ->where( [
                                     'user_ip'     => $user_ip,
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

            $possible_answers = PossibleAnswers::find()
                                               ->where( [ 'question' => $question->id ] )
                                               ->all();

            $db = new Connection( Yii::$app->db );

            $answers = $db->createCommand( "SELECT `possible_answers_id`,
                                                     COUNT(id)
                                                     FROM `answers`
                                                     WHERE `answers`.`question_id` = $question->id
                                                     GROUP BY `possible_answers_id`
                                                     " );

            $answers       = ArrayHelper::map( $answers->queryAll(), 'possible_answers_id', 'COUNT(id)' );
            $answers_count = Answers::find()
                                    ->where( [ 'question_id' => $question->id ] )
                                    ->count();

            $answers_array = [ ];
            foreach ( $possible_answers as $possible_answer ) {
                $answers_array[ $possible_answer->id ] = [
                    'answer'  => $possible_answer->title,
                    'val'     => ( ! empty( $answers[ $possible_answer->id ] ) ) ? $answers[ $possible_answer->id ] : 0,
                    'val_per' => floor( $answers[ $possible_answer->id ] / $answers_count * 100 )
                ];
            }


            return $this->render( 'poll-result', [

                'question'         => $question,
                'possible_answers' => $answers_array,
                'answers_count'    => $answers_count,
            ] );

        }
//        }
    }
}