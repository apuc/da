<?php

namespace frontend\modules\stream\controllers;

use backend\modules\comments\models\Comments;
use common\classes\Debug;
use common\models\db\KeyValue;
use common\models\db\VkComments;
use common\models\db\VkStream;
use common\models\User;
use frontend\models\user\Profile;
use yii\web\Controller;
use yii\web\Cookie;
use Yii;

/**
 * Default controller for the `stream` module
 */
class DefaultController extends Controller
{
    public function init()
    {
        $this->on('beforeAction', function ($event) {

            // запоминаем страницу неавторизованного пользователя, чтобы потом отредиректить его обратно с помощью  goBack()
            if (Yii::$app->getUser()->isGuest) {
                $request = Yii::$app->getRequest();
                // исключаем страницу авторизации или ajax-запросы
                if (!($request->getIsAjax() || strpos($request->getUrl(), 'login') !== false)) {
                    Yii::$app->getUser()->setReturnUrl($request->getUrl());
                }
            }
        });
    }

    /*public function beforeAction($action)
    {
       if($action == 'get-new-post')
           $this->enableCsrfValidation = false ;
       return true;
    }*/

    /**
     * Renders the index view for the module
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $model = VkStream::getPosts();

        foreach ($model as $item)
        {
            $item->getAllComments();
        }

        $result = $this->getColumns($model);
        $count = VkStream::getPublishedCount();
        //$this->setPublishedCount();

        return $this->render('index', [
            'model1' => $result[1],
            'model2' => $result[2],
            'count' => $count,
            'meta_title' => KeyValue::findOne( [ 'key' => 'stream_title_page' ] )->value,
            'meta_desc' => KeyValue::findOne( [ 'key' => 'stream_desc_page' ] )->value,
        ]);
    }

    public function actionLoadMore()
    {
        $dt_publish = \Yii::$app->request->post('dt_add');


        if(\Yii::$app->request->post('step') !== null){
            $models = VkStream::getPosts(10, \Yii::$app->request->post('step') * 10, $dt_publish);

               foreach ($models as $model)
               {
                   $model->getAllComments();
                   $result['render'][] = $this->renderPartial('more-stream', ['item' => $model]);
               }
                $result['count'] = (count($models) < 10) ? 0 : 1;
                return  json_encode($result);

        }
        return false;
    }

    public function actionView($slug)
    {
        $model = VkStream::find()->with('photo', 'comments', 'author', 'group')
            ->where(['slug' => $slug])
            ->one();

        if(empty($model))
        {
            return $this->render('view', [
                'model' => $model,
                'count' => VkStream::getPublishedCount(),
                ]);
        }

        $model->getAllComments();
        $model->views += 1;
        $model->save();
        $interested = VkStream::find()->with('photo', 'comments', 'author', 'group')
            ->where(['status' => 1])
            ->andWhere(['<', 'dt_publish', $model->dt_publish])
            ->orderBy('dt_publish DESC')
            ->limit(10)
            ->offset(0)
            ->all();

        foreach ($interested as $item)
        {
            $item->getAllComments();
        }

        $interested = $this->getColumns($interested);

        return $this->render('view', [
            'model' => $model,
            'interested1' => $interested[1],
            'interested2' => $interested[2],
            'count' => VkStream::getPublishedCount(),
        ]);
    }

    public function getColumns($data)
    {
        $i = 1;
        if(!empty($data))
        {
            foreach ($data as $d)
            {
                if($i % 2 == 0) $result[2][] = $d;
                else $result[1][] = $d;
                $i++;
            }
            $result[2] = (isset($result[2]))? $result[2] : 0;
            return $result;
        }
        return false;
    }
}
