<?php

namespace backend\modules\contacting\controllers;

use common\classes\Debug;
use Yii;
use backend\modules\contacting\models\Contacting;
use backend\modules\contacting\models\ContactingSeacrh;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactingController implements the CRUD actions for Contacting model.
 */
class ContactingController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contacting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactingSeacrh();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Contacting();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionSendMail($id)
    {
        $model = Contacting::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            //Debug::prn(Yii::$app->request->post('Contacting'));
            $contact = Yii::$app->request->post('Contacting');
            $text = 'Ваш вопрос: ' . $contact['content'] . "\n" . 'Ответ: ' . "\n";
            //Debug::prn($contact);
            Yii::$app->mailer->compose()
                ->setFrom('noreply@da-info.pro')
                ->setTo($contact['email'])
                ->setSubject(Yii::$app->request->post('subject'))
                ->setTextBody($text . Yii::$app->request->post('text-mail'))
                ->send();
            $model->answer = Yii::$app->request->post('text-mail');
            $model->status = 1;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('sendmail', ['model' => $model]);
    }

    /**
     * Displays a single Contacting model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contacting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contacting();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Contacting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contacting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contacting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
