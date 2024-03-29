<?php

namespace frontend\modules\stream\controllers;

use backend\modules\comments\models\Comments;
use common\classes\Debug;
use common\models\db\GooglePlusPosts;
use common\models\db\KeyValue;
use common\models\db\TwPosts;
use common\models\db\VkComments;
use common\models\db\VkStream;
use common\models\db\InstPhoto;
use common\models\Stream;
use common\models\User;
use frontend\controllers\MainWebController;
use frontend\models\user\Profile;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Cookie;
use Yii;


class DefaultController extends MainWebController
{
    public function init()
    {
        parent::init();

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

    public function actionIndex($social = 'all')
    {

        if ($social === 'vk') {
            $res = VkStream::getPosts();
        } else if ($social === 'tw') {
            $res = TwPosts::find()
                ->where(['status' => 1])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
        } else if ($social === 'gplus') {
            $res = GooglePlusPosts::find()
                ->where(['status' => 1])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
        }else if($social==="inst"){

            $res = InstPhoto::find()->where("status=2")->orderBy('dt_publish DESC')
                ->limit(10)->all();
        } else {

        $model = VkStream::getPosts();
        $tw = TwPosts::find()
            ->where(['status' => 1])
            ->orderBy('`dt_publish` DESC')
            ->limit(10)
            ->all();
        $gPlus = GooglePlusPosts::find()
            ->where(['status' => 1])
            ->orderBy('`dt_publish` DESC')
            ->limit(10)
            ->all();
        $inst = InstPhoto::find()->where("status=2")->orderBy('dt_publish DESC')
            ->limit(10)->all();
        $res = array_merge($gPlus, $model, $tw);
        }
        ArrayHelper::multisort($res, 'dt_publish', [SORT_DESC]);


        $result = $this->getColumns(Stream::create($res));

        $countTw = TwPosts::find()->where(['status' => 1])->count();
        $countVk = VkStream::getPublishedCount();
        $countGplus = GooglePlusPosts::find()->where(['status' => 1])->count();
        $countInst = InstPhoto::find()->where(['status'=>2])->count();
        $count = $countTw + $countVk + $countGplus+$countInst;


        return $this->render('index', [
            'model1' => $result[1],
            'model2' => $result[2],
            'count' => $count,
            'countTw' => $countTw,
            'countVk' => $countVk,
            'countInst' => $countInst,
            'countGplus' => $countGplus,
            'meta_title' => KeyValue::findOne(['key' => 'stream_title_page'])->value,
            'meta_desc' => KeyValue::findOne(['key' => 'stream_desc_page'])->value,
        ]);
    }

    public function actionLoadMore()
    {
        $dt_publish = \Yii::$app->request->post('dt_add');
        $lpd = \Yii::$app->request->post('last_publish_date');
        $type = \Yii::$app->request->post('type');
        if ($lpd) {
            if ($type === 'vk') {
                $res = VkStream::find()
                    ->where(['status' => 1])
                    ->andWhere(['<', 'dt_publish', $lpd])
                    //->andWhere(['>', 'dt_publish', 0])
                    ->orderBy('`vk_stream`.`dt_publish` DESC')
                    ->limit(10)
                    ->with('gif', 'photo', 'author', 'group')
                    ->all();
            } else if ($type === 'tw') {
                $res = TwPosts::find()
                    ->where(['status' => 1])
                    ->andWhere(['<', 'dt_publish', $lpd])
                    ->orderBy('`dt_publish` DESC')
                    ->limit(10)
                    ->all();
            } else if ($type === 'gplus') {
                $res = $gPlus = GooglePlusPosts::find()
                    ->where(['status' => 1])
                    ->andWhere(['<', 'dt_publish', $lpd])
                    ->orderBy('`dt_publish` DESC')
                    ->limit(10)
                    ->all();
            } else if ($type === 'all') {
                $tw = TwPosts::find()
                    ->where(['status' => 1])
                    ->andWhere(['<', 'dt_publish', $lpd])
                    ->orderBy('`dt_publish` DESC')
                    ->limit(10)
                    ->all();
                $vk = VkStream::find()
                    ->where(['status' => 1])
                    ->andWhere(['<', 'dt_publish', $lpd])
                    //->andWhere(['>', 'dt_publish', 0])
                    ->orderBy('`vk_stream`.`dt_publish` DESC')
                    ->limit(10)
                    ->with('gif', 'photo', 'author', 'group')
                    ->all();
                $gPlus = GooglePlusPosts::find()
                    ->where(['status' => 1])
                    ->andWhere(['<', 'dt_publish', $lpd])
                    ->orderBy('`dt_publish` DESC')
                    ->limit(10)
                    ->all();

                $res = array_merge($vk, $tw, $gPlus);
            }
            ArrayHelper::multisort($res, 'dt_publish', [SORT_DESC]);
            $res = Stream::create($res);
            $result = [];
            for ($i = 0; $i < 10; $i++) {
                $result['render'][] = $this->renderPartial('more-stream', ['item' => $res[$i]]);
            }
            $result['count'] = 1;
            $result['lpd'] = $res[9]->dt_publish;
            return json_encode($result);
        }


        //if(\Yii::$app->request->post('step') !== null){
        //    $models = VkStream::getPosts(10, \Yii::$app->request->post('step') * 10, $dt_publish);
        //
        //       foreach ($models as $model)
        //       {
        //           $model->getAllComments();
        //           $result['render'][] = $this->renderPartial('more-stream', ['item' => $model]);
        //       }
        //        $result['count'] = (count($models) < 10) ? 0 : 1;
        //        return  json_encode($result);
        //
        //}
        return false;
    }

    public function actionView($slug, $type = null, $social = 'all')
    {
        $model = null;
        if (null === $type) {
            $model = VkStream::find()->with('photo', 'comments', 'author', 'group')
                ->where(['slug' => $slug])
                ->one();
        }
        if ('tw' === $type) {
            $model = TwPosts::find()->where(['slug' => $slug])->one();
        }
        if ('gplus' === $type) {
            $model = GooglePlusPosts::find()->where(['slug' => $slug])->one();
        }
        if ('inst' === $type) {
            $model = InstPhoto::find()->where(['slug' => $slug])->one();
        }


        $countTw = TwPosts::find()->where(['status' => 1])->count();
        $countVk = VkStream::getPublishedCount();
        $countGplus = GooglePlusPosts::find()->where(['status' => 1])->count();
        $countInst = InstPhoto::find()->where(['status'=>2])->count();
        $count = $countTw + $countVk + $countGplus+ $countInst;
        if (empty($model)) {
            return $this->render('view', [
                'model' => $model,
                'count' => $count,
                'interested2' => null,
                'interested1' => null,
                'countVk' => $countVk,
                'countTw' => $countTw,
                'countGplus' => $countGplus,
            ]);
        }

        //$model->getAllComments();
        $model->views += 1;
        $model->save();
        if($social === 'vk') {
            $res = VkStream::find()->with('photo', 'comments', 'author', 'group')
                ->where(['status' => 1])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('dt_publish DESC')
                ->limit(10)
                ->all();
        } else if ($social === 'tw') {
            $res = TwPosts::find()
                ->where(['status' => 1])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
        } else if ($social === 'gplus'){
            $res = GooglePlusPosts::find()
                ->where(['status' => 1])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
        } else if ($social === 'gplus'){
            $res = GooglePlusPosts::find()
                ->where(['status' => 1])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
        }else if ($social === 'inst'){
            $res = InstPhoto::find()
                ->where(['status' => 2])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
        }else {
            $vk = VkStream::find()->with('photo', 'comments', 'author', 'group')
                ->where(['status' => 1])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('dt_publish DESC')
                ->limit(10)
                ->all();
            $tw = TwPosts::find()
                ->where(['status' => 1])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
            $Gplus = GooglePlusPosts::find()
                ->where(['status' => 1])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
            $inst = InstPhoto::find()
                ->where(['status' => 2])
                ->andWhere(['<', 'dt_publish', $model->dt_publish])
                ->orderBy('`dt_publish` DESC')
                ->limit(10)
                ->all();
            $res = array_merge($vk, $tw, $Gplus,$inst);
        }

        ArrayHelper::multisort($res, 'dt_publish', [SORT_DESC]);
        $res = Stream::create($res);

        //foreach ($interested as $item)
        //{
        //    $item->getAllComments();
        //}

        $interested = $this->getColumns($res);

        return $this->render('view', [
            'model' => Stream::createItem($model),
            'interested1' => $interested[1],
            'interested2' => $interested[2],
            'count' => $count,
            'countVk' => $countVk,
            'countTw' => $countTw,
            'countGplus' => $countGplus,
            'countInst' => $countInst,
        ]);
    }

    public function getColumns($data)
    {
        $i = 1;
        if (!empty($data)) {
            foreach ($data as $d) {
                if ($i <= 10) {
                    if ($i % 2 == 0) $result[2][] = $d;
                    else $result[1][] = $d;
                    $i++;
                }
            }
            $result[2] = (isset($result[2])) ? $result[2] : 0;
            return $result;
        }
        return false;
    }

    public function getStreamItemsByType($type){

    }

}
