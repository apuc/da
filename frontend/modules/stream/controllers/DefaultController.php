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
        $result = $this->getColumns($model);
        $count = VkStream::getPublishedCount();
        return $this->render('index', [
            'model1' => $result[1],
            'model2' => $result[2],
            'count' => $count,
            'time' => 0
        ]);
    }

    public function actionLoadMore()
    {
        $s = [];

        if(\Yii::$app->request->post('step') !== null){
            $model = VkStream::getPosts(10, \Yii::$app->request->post('step') * 10);
                $result = $this->getColumns($model);
                $s['first_column'] = $this->renderPartial('more-stream', ['model' => $result[1]]);
                $s['second_column'] = $this->renderPartial('more-stream', ['model' => $result[2]]);
                $s['count'] = (count($model) < 10) ? 0 : 1;
                //Debug::prn($step);
                return  json_encode($s);

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
        $interested = $this->getColumns($interested);

        return $this->render('view', [
            'model' => $model,
            'interested1' => $interested[1],
            'interested2' => $interested[2]
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
