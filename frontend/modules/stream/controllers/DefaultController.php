<?php

namespace frontend\modules\stream\controllers;

use common\classes\Debug;
use common\models\db\VkComments;
use common\models\db\VkStream;
use yii\web\Controller;

/**
 * Default controller for the `stream` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public function actionIndex()
    {
        $model = VkStream::getPosts();
       // Debug::prn($model);
        //$result = $this->getColumns($model);
        $count = VkStream::getPublishedCount();
        return $this->render('index', [
            'model' => $model,
            'count' => $count,
            'time' => 0
        ]);
    }

    public function actionLoadMore()
    {

        if(\Yii::$app->request->post('step') !== null){
            $model = VkStream::getPosts(10, \Yii::$app->request->post('step') * 10);
               /* $result = $this->getColumns($model);
                $s['first_column'] = $this->renderPartial('more-stream', ['model' => $result[1]]);
                $s['second_column'] = $this->renderPartial('more-stream', ['model' => $result[2]]);
                $s['count'] = (count($model) < 10) ? 0 : 1;*/
                //Debug::prn($step);
                $result['render'] = $this->renderPartial('more-stream', ['model' => $model]);
                $result['count'] = (count($model) < 10) ? 0 : 1;
                return  json_encode($result);

        }
        return false;
    }

    public function actionView($id)
    {
        $model = VkStream::find()->with('photo', 'comments', 'author', 'group')
            ->where(['id' => $id])
            ->one();
        $model->views += 1;
        $model->save();

        $interested = VkStream::find()->with('photo', 'comments', 'author', 'group')
            ->where(['status' => 1])
            ->andWhere(['<>', 'id', $id])
            ->orderBy('dt_add DESC')
            ->limit(10)
            ->offset(0)
            ->all();
        //$interested = $this->getColumns($interested);
        $count = VkStream::getPublishedCount();

        return $this->render('view', [
            'model' => $model,
            'interested' => $interested,
            'count' => $count
        ]);
    }

    public function getColumns($data)
    {
        $i = 1;
        foreach ($data as $d)
        {
            if($i % 2 == 0) $result[2][] = $d;
            else $result[1][] = $d;
            $i++;
        }
        return $result;
    }

    public function actionPjax()
    {
        return date('H:i:s');
    }
}
