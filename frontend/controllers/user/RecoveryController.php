<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 05.05.2016
 * Time: 10:02
 */

namespace frontend\controllers\user;


use dektrium\user\models\RecoveryForm;
use dektrium\user\models\Token;
use Yii;
use yii\web\NotFoundHttpException;

class RecoveryController extends \dektrium\user\controllers\RecoveryController
{

    public function actionRequest()
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var RecoveryForm $model */
        $model = Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => 'request',
        ]);
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_REQUEST, $event);

        if ($model->load(Yii::$app->request->post()) && $model->sendRecoveryMessage()) {
            $this->trigger(self::EVENT_AFTER_REQUEST, $event);
            return $this->render('recovery-msg', [
                'title'  => Yii::t('user', 'Recovery message sent'),
                'module' => $this->module,
            ]);
            //echo 123;
        }

        return $this->render('request', [
            'model' => $model,
        ]);
    }


    /**
     * Displays page where user can reset password.
     *
     * @param int    $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionReset($id, $code)
    {
        if (!$this->module->enablePasswordRecovery) {
            throw new NotFoundHttpException();
        }

        /** @var Token $token */
        $token = $this->finder->findToken(['user_id' => $id, 'code' => $code, 'type' => Token::TYPE_RECOVERY])->one();
        $event = $this->getResetPasswordEvent($token);

        $this->trigger(self::EVENT_BEFORE_TOKEN_VALIDATE, $event);

        if ($token === null || $token->isExpired || $token->user === null) {
            $this->trigger(self::EVENT_AFTER_TOKEN_VALIDATE, $event);
            Yii::$app->session->setFlash('danger', Yii::t('user', 'Recovery link is invalid or expired. Please try requesting a new one.'));
            return $this->render('/message', [
                'title'  => Yii::t('user', 'Invalid or expired link'),
                'module' => $this->module,
            ]);
        }

        /** @var RecoveryForm $model */
        $model = Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => 'reset',
        ]);
        $event->setForm($model);

        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_RESET, $event);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->resetPassword($token)) {
            $this->trigger(self::EVENT_AFTER_RESET, $event);

            return $this->render('passwordChanged',
                [
                    'title'  => Yii::t('user', 'Password has been changed'),
                    'module' => $this->module,
                ]);

            /*return $this->render('/message', [
                'title'  => Yii::t('user', 'Password has been changed'),
                'module' => $this->module,
            ]);*/
        }

        return $this->render('reset', [
            'model' => $model,
        ]);
    }
}