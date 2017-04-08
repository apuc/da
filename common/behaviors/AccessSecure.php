<?php

namespace common\behaviors;

use common\classes\Debug;
use common\classes\UserFunction;
use Yii;
use yii\base\ActionFilter;
use yii\base\Behavior;
use yii\di\Instance;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\web\User;

class AccessSecure extends ActionFilter
{


    /**
     * @var User|array|string the user object representing the authentication status or the ID of the user application component.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $user = 'user';
    /**
     * @var callable a callback that will be called if the access should be denied
     * to the current user. If not set, [[denyAccess()]] will be called.
     *
     * The signature of the callback should be as follows:
     *
     * ```php
     * function ($rule, $action)
     * ```
     *
     * where `$rule` is the rule that denies the user, and `$action` is the current [[Action|action]] object.
     * `$rule` can be `null` if access is denied because none of the rules matched.
     */
    public $denyCallback;
    /**
     * @var array the default configuration of access rules. Individual rule configurations
     * specified via [[rules]] will take precedence when the same property of the rule is configured.
     */
    public $ruleConfig = ['class' => 'yii\filters\AccessRule'];
    /**
     * @var array a list of access rule objects or configuration arrays for creating the rule objects.
     * If a rule is specified via a configuration array, it will be merged with [[ruleConfig]] first
     * before it is used for creating the rule object.
     * @see ruleConfig
     */
    public $rules = [];

   public function init()
    {
        parent::init();
        $this->user = Instance::ensure($this->user, User::className());
        foreach ($this->rules as $i => $rule) {
            if (is_array($rule)) {
                $this->rules[$i] = Yii::createObject(array_merge($this->ruleConfig, $rule));
            }
        }
    }

    public function beforeAction($action)
    {

        if (Yii::$app->user->isGuest || UserFunction::getRole_user()['admin']){
            $user = $this->user;
            $request = Yii::$app->getRequest();
            /* @var $rule AccessRule */
            foreach ($this->rules as $rule) {
                if ($allow = $rule->allows($action, $user, $request)) {
                    return true;
                } elseif ($allow === false) {
                    if (isset($rule->denyCallback)) {
                        call_user_func($rule->denyCallback, $rule, $action);
                    } elseif ($this->denyCallback !== null) {
                        call_user_func($this->denyCallback, $rule, $action);
                    } else {
                        $this->denyAccess($user);
                    }
                    return false;
                }
            }
            if ($this->denyCallback !== null) {
                call_user_func($this->denyCallback, null, $action);
            } else {
                $this->denyAccess($user);
            }
            return false;
        }
        else{
            return Yii::$app->controller->redirect(Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/']));
        }
        /*if(!UserFunction::getRole_user()['admin']) {
            return Yii::$app->controller->redirect(Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/index']));
        }else {*/

        /*}*/
    }


    /**
     * Denies the access of the user.
     * The default implementation will redirect the user to the login page if he is a guest;
     * if the user is already logged, a 403 HTTP exception will be thrown.
     * @param User $user the current user
     * @throws ForbiddenHttpException if the user is already logged in.
     */
    protected function denyAccess($user)
    {
        if ($user->getIsGuest()) {
            $user->loginRequired();
        } else {
            throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
        }
    }

}