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
        $user = UserDec::find()->where(['!=', 'confirmed_at', 'NULL'])->all();
        $subject = 'С Новым Годом';
        //$msg = $this->renderPartial('n_moder',['product'=>$item,'daysEnd' => $daysEnd]);

        Yii::$app->mailer->compose('new-year')
            ->setTo(['korol_dima@list.ru', 'apuc06@mail.ru'])
            ->setFrom(['noreply@da-info.pro' => 'Команда DA-Info'])
            ->setSubject($subject)
            ->send();

        /*foreach ($user as $item) {
            //Debug::prn(ArrayHelper::getValue($item, 'email'));
            $subject = 'С Новым Годом';
            //$msg = $this->renderPartial('n_moder',['product'=>$item,'daysEnd' => $daysEnd]);


            Yii::$app->mailer->compose('new-year')
                ->setTo(ArrayHelper::getValue($item, 'email'))
                ->setFrom(['noreply@da-info.pro' => 'Команда портала DA-Info'])
                ->setSubject($subject)
                ->send();
        }*/
        Yii::$app->session->setFlash('success','Письма успешно отправленны.');
        return $this->redirect('index');
    }
}
