<?php
namespace backend\controllers;

use common\behaviors\AccessSecure;
use common\classes\Debug;
use frontend\models\user\UserDec;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{

    function init()
    {
        parent::init();
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessSecure::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'get-mail'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionGetMail()
    {
        $users = UserDec::find()->where(['!=', 'confirmed_at', 'NULL'])->all();

        $messages = [];
        $subject = 'С Новым Годом';
        foreach ($users as $user) {
            $messages[] = Yii::$app->mailer->compose('new-year')
                // ...
                ->setTo($user->email)
                ->setFrom(['noreply@da-info.pro' => 'Команда DA-Info'])
                ->setSubject($subject);
        }
        Yii::$app->mailer->sendMultiple($messages);

        /*foreach ($user as $item) {
            Debug::prn(ArrayHelper::getValue($item, 'email'));
            Debug::prn($item->email);
            $subject = 'С Новым Годом';
            //$msg = $this->renderPartial('n_moder',['product'=>$item,'daysEnd' => $daysEnd]);


            Yii::$app->mailer->compose('new-year')
                ->setTo($item->email)
                ->setFrom(['noreply@da-info.pro' => 'Команда DA-Info'])
                ->setSubject($subject)
                ->send();
        }*/

        $subject = 'Рассылка С Новым Годом успешно завершена';
        //$msg = $this->renderPartial('n_moder',['product'=>$item,'daysEnd' => $daysEnd]);

        Yii::$app->mailer->compose('new-year')
            ->setTo(['korol_dima@list.ru'])
            ->setFrom(['noreply@da-info.pro' => 'Команда DA-Info'])
            ->setSubject($subject)
            ->send();

        Yii::$app->session->setFlash('success','Письма успешно отправленны.');
        return $this->redirect('index');
    }
}
