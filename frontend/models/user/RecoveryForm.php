<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 05.05.2016
 * Time: 9:52
 */

namespace frontend\models\user;


use dektrium\user\models\Token;
use Yii;

class RecoveryForm extends \dektrium\user\models\RecoveryForm
{

    /**
     * Sends recovery message.
     *
     * @return bool
     */
    public function sendRecoveryMessage()
    {
        if ($this->validate()) {
            /** @var Token $token */
            $token = Yii::createObject([
                'class'   => Token::className(),
                'user_id' => $this->user->id,
                'type'    => Token::TYPE_RECOVERY,
            ]);

            if (!$token->save(false)) {
                return false;
            }

            if (!$this->mailer->sendRecoveryMessage($this->user, $token)) {
                return false;
            }


            return true;
        }

        return false;
    }

    /**
     * Resets user's password.
     *
     * @param Token $token
     *
     * @return bool
     */
    public function resetPassword(Token $token)
    {
        if (!$this->validate() || $token->user === null) {
            return false;
        }

        if ($token->user->resetPassword($this->password)) {

            $token->delete();
        } else {

        }

        return true;
    }
}