<?php

namespace backend\modules\comments\controllers;

use common\behaviors\AccessSecure;
use common\classes\Debug;
use common\models\db\NewsComments;
use common\models\db\PagesComments;
use common\models\db\StockComments;
use common\models\db\VkStreamComments;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * CommentsController implements the CRUD actions for Comments model.
 */
class CommentsController extends Controller
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
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'multi-delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionMultiDelete()
    {
        Debug::prn(Yii::$app->request->post());
        /*if($keyList = Yii::$app->request->post('keyList'))
        {
            $arrKey = explode(',', $keyList);
            //var_dump($arrKey); // Получен массив со значениями
        }
        return false;*/
    }

    /**
     * @return array
     */
    public function actionMultiModerCheckedAjax()
    {
        $response = [];
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            foreach ($post['keyList'] as $id) {
                $model = $this->findModelByType($id, $post['type']);
                if ($model->moder_checked == 0) {
                    $model->moder_checked = 1;
                }
                $model->save();
                $response[] = [
                    'id' => $id,
                    'status' => $model->moder_checked
                ];
            }
        }
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        return $response;
    }

    /**
     * @return array
     */
    public function actionMultiPublishedAjax()
    {
        $response = [];
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            foreach ($post['keyList'] as $id) {
                $model = $this->findModelByType($id, $post['type']);
                if ($model->published == 0) {
                    $model->published = 1;
                }
                $model->save();
                $response[] = [
                    'id' => $id,
                    'status' => $model->published
                ];
            }
        }
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        return $response;
    }

    /**
     * @return array
     */
    public function actionUpdateModerCheckedAjax()
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $model = $this->findModelByType($post['id'], $post['type']);
            if ($model->moder_checked == 0) {
                $model->moder_checked = 1;
            } else {
                $model->moder_checked = 0;
            }
            $model->save();

            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return [
                'id' => $post['id'],
                'status' => $model->moder_checked
            ];
        }
    }

    /**
     * @return array
     */
    public function actionUpdatePublishedAjax()
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $model = $this->findModelByType($post['id'], $post['type']);
            if ($model->published == 0) {
                $model->published = 1;
            } else {
                $model->published = 0;
            }
            $model->save();

            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return [
                'id' => $post['id'],
                'status' => $model->published
            ];
        }
    }

    /**
     * @return array
     */
    public function actionUpdateVerifiedAjax()
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $model = $this->findModelByType($post['id'], $post['type']);
            if ($model->verified == 0) {
                $model->verified = 1;
            } else {
                $model->verified = 0;
            }
            $model->save();

            Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
            return [
                'id' => $post['id'],
                'status' => $model->verified
            ];
        }
    }

    /**
     * @param $id
     * @param $type
     * @return null|object
     */
    public function findModelByType($id, $type)
    {
        switch ($type) {
            case 'news':
                $model = NewsComments::findOne(['id' => $id]);
                break;
            case 'pages':
                $model = PagesComments::findOne(['id' => $id]);
                break;
            case 'vk_stream':
                $model = VkStreamComments::findOne(['id' => $id]);
                break;
            case 'stock':
                $model = StockComments::findOne(['id' => $id]);
                break;
        }
        return $model;
    }
}
