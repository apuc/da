<?php
/**
 * Created by PhpStorm.
 * User: Офис
 * Date: 04.05.2016
 * Time: 12:42
 */

namespace frontend\controllers\user;


use common\classes\Debug;
use dektrium\user\controllers\RegistrationController;
use dektrium\user\models\RegistrationForm;
use dektrium\user\models\ResendForm;
use Yii;
use yii\web\NotFoundHttpException;

class RegUserController extends RegistrationController
{

    /**
     * Displays the registration page.
     * After successful registration if enableConfirmation is enabled shows info message otherwise redirects to home page.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionRegister()
    {
        if (!$this->module->enableRegistration) {
            throw new NotFoundHttpException();
        }

        /** @var RegistrationForm $model */
        $model = Yii::createObject(RegistrationForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_REGISTER, $event);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->register()) {

            $this->trigger(self::EVENT_AFTER_REGISTER, $event);

            $link = explode('@',$_POST['register-form']['email']);

            return $this->render('@app/views/user/registration/reg-message', [
                'title'  => Yii::t('user', 'Your account has been created'),
                'module' => $this->module,
                'link' => $link[1],
            ]);
        }

        return $this->render('register', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }

    /**
     * Displays page where user can request new confirmation token. If resending was successful, displays message.
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionResend()
    {
        if ($this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }

        /** @var ResendForm $model */
        $model = Yii::createObject(ResendForm::className());
        $event = $this->getFormEvent($model);

        $this->trigger(self::EVENT_BEFORE_RESEND, $event);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->request->post()) && $model->resend()) {

            $this->trigger(self::EVENT_AFTER_RESEND, $event);

            $link = explode('@',$_POST['resend-form']['email']);
//Debug::prn($_POST);
            return $this->render('@app/views/user/registration/reg-message', [
                'title'  => Yii::t('user', 'Your account has been created'),
                'module' => $this->module,
                'link' => $link[1],
            ]);
        }

        return $this->render('resend', [
            'model' => $model,
        ]);
    }

    /**
     * Confirms user's account. If confirmation was successful logs the user and shows success message. Otherwise
     * shows error message.
     *
     * @param int    $id
     * @param string $code
     *
     * @return string
     * @throws \yii\web\HttpException
     */
    public function actionConfirm($id, $code)
    {
        $user = $this->finder->findUserById($id);

        if ($user === null || $this->module->enableConfirmation == false) {
            throw new NotFoundHttpException();
        }

        $event = $this->getUserEvent($user);

        $this->trigger(self::EVENT_BEFORE_CONFIRM, $event);

        $user->attemptConfirmation($code);

        $this->trigger(self::EVENT_AFTER_CONFIRM, $event);
        return $this->render('confirmInfo', ['title'  => Yii::t('user', 'Account confirmation'), 'module' => $this->module]);
        /*return $this->render('confirm', [
            'title'  => Yii::t('user', 'Account confirmation'),
            'module' => $this->module,
        ]);*/
    }

}