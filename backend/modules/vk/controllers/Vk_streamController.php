<?php

namespace backend\modules\vk\controllers;

use backend\modules\vk\models\VkAuthors;
use common\classes\Debug;
use common\models\db\VkComments;
use common\models\db\VkGif;
use common\models\db\VkPhoto;
use Yii;
use backend\modules\vk\models\VkStream;
use backend\modules\vk\models\VkStreamSearch;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\JsonResponseFormatter;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Vk_streamController implements the CRUD actions for VkStream model.
 */
class Vk_streamController extends Controller
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
     * Lists all VkStream models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VkStreamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['status' => 0], 'dt_add');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VkStream model.
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
     * Creates a new VkStream model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VkStream();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing VkStream model.
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
     * Deletes an existing VkStream model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        VkPhoto::deleteAll(['post_id' => $id]);
        VkGif::deleteAll(['post_id' => $id]);
        VkComments::deleteAll(['post_id' => $id]);

        return $this->redirect(['index']);
    }

    /**
     * Finds the VkStream model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VkStream the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VkStream::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSetStatus()
    {
        if(Yii::$app->request->post('id') !== null){
            $id = Yii::$app->request->post('id');
            $status = Yii::$app->request->post('status');
            \common\models\db\VkStream::updateAll(
                [
                    'status' => $status,
                    'user_id' => Yii::$app->user->id,
                ],
                ['id' => $id]);
        }
    }

    public function actionGetComments()
    {
        $photo = '';
        $comments = VkComments::find()->with('author', 'photo')
            ->where(['post_id' => Yii::$app->request->post('id')])
            ->orderBy('dt_add')
            ->all();

        foreach ($comments as &$comment)
        {
            $comment['dt_add'] = date('H:i:s d-m-y ', $comment['dt_add']);
            if(empty($comment->author))
            {
                $comment->group['name'] = 'Группа';
                $comment->group['link'] = 'club'.substr($comment['from_id'], 1, strlen($comment['from_id']));
            }

            if(!empty($comment->photo)){

                switch (empty($comment->img)){
                    case ($comment->photo[0]['photo_75']):
                        $comment->img = $comment->photo[0]['photo_75'];
                        break;
                    case ($comment->photo[0]['photo_130']):
                        $comment->img = $comment->photo[0]['photo_75'];
                        break;
                    case ($comment->photo[0]['photo_512']):
                        $comment->img = $comment->photo[0]['photo_512'];
                        break;
                    case ($comment->photo[0]['photo_604']):
                        $comment->img = $comment->photo[0]['photo_604'];
                        break;
                    case ($comment->photo[0]['photo_807']):
                        $comment->img = $comment->photo[0]['photo_807'];
                        break;
                    case ($comment->photo[0]['photo_1280']):
                        $comment->img = $comment->photo[0]['photo_1280'];
                        break;
                }
            }
        }

        if($comments)
           return $this->renderPartial('comment_ajax', ['comments' =>$comments, 'photo' => $photo]);
        else return Json::encode(0);

    }

    public function actionDelComment()
    {
        $model = VkComments::findOne(Yii::$app->request->post('id'));

        if($model->delete())
            return true;
        else return false;
    }
}
