<?php

namespace frontend\modules\stream\controllers;

use common\classes\Debug;
use common\models\db\VkComments;
use common\models\db\VkStream;
use yii\web\Controller;
use yii\web\Cookie;

/**
 * Default controller for the `stream` module
 */
class DefaultController extends Controller
{
    public function beforeAction($action)
    {
       if($action == 'get-new-post')
           $this->enableCsrfValidation = false ;
       return true;
    }

    /**
     * Renders the index view for the module
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $model = VkStream::getPosts();
       // Debug::prn($model);
        $result = $this->getColumns($model);

        //Debug::prn($max_id);
        $count = VkStream::getPublishedCount();
        $this->setPublishedCount();



        return $this->render('index', [
            'model1' => $result[1],
            'model2' => $result[2],
            'count' => $count
        ]);
    }

    public function actionLoadMore()
    {
        if(\Yii::$app->request->post('step') !== null){
            $models = VkStream::getPosts(10, \Yii::$app->request->post('step') * 10);
               /*$result = $this->getColumns($model);
                $s['first_column'] = $this->renderPartial('more-stream', ['model' => $result[1]]);
                $s['second_column'] = $this->renderPartial('more-stream', ['model' => $result[2]]);
                $s['count'] = (count($model) < 10) ? 0 : 1;
                //Debug::prn($step);*/
               foreach ($models as $model)
               {
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
        if(!empty($model))
        {
            $model->views += 1;
            $model->save();
        }


        $interested = VkStream::find()->with('photo', 'comments', 'author', 'group')
            ->where(['status' => 1])
            ->andWhere(['<', 'dt_add', $model->dt_add])
            ->orderBy('dt_add DESC')
            ->limit(10)
            ->offset(0)
            ->all();
        $interested = $this->getColumns($interested);
        //$count = VkStream::getPublishedCount();
        $this->setPublishedCount();

        return $this->render('view', [
            'model' => $model,
            'interested1' => $interested[1],
            'interested2' => $interested[2],
            'count' => VkStream::getPublishedCount()
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

    public function actionGetNewPost()
    {
        $countNew = VkStream::getPublishedCount() - \Yii::$app->request->post('count');

        return ($countNew > 0) ? $countNew : 0 ;
    }

    public function setPublishedCount()
    {
        $count = VkStream::getPublishedCount();
        \Yii::$app->response->cookies->add(new Cookie([
            'name' => 'count',
            'value' => $count
        ]));
    }
}
