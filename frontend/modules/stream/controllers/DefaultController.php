<?php

namespace frontend\modules\stream\controllers;

use backend\modules\comments\models\Comments;
use common\classes\Debug;
use common\models\db\VkComments;
use common\models\db\VkStream;
use common\models\User;
use frontend\models\user\Profile;
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

       $comment = $this->commentsItem($model);
        //Debug::prn($comment);

        //$this->getComments($model);
        $result = $this->getColumns($model);

        //Debug::prn($max_id);
        $count = VkStream::getPublishedCount();
        $this->setPublishedCount();
        //Debug::prn($comment);



        return $this->render('index', [
            'model1' => $result[1],
            'model2' => $result[2],
            'comment' => $comment,
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
        $comment = $this->commentsItem($interested);

        $interested = $this->getColumns($interested);
        //$count = VkStream::getPublishedCount();
        $this->setPublishedCount();

        return $this->render('view', [
            'model' => $model,
            'interested1' => $interested[1],
            'interested2' => $interested[2],
            'count' => VkStream::getPublishedCount(),
            'comment' => $comment
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

    public function actionSetComment()
    {
        $profile = Profile::findOne(['user_id' => \Yii::$app->user->identity->id]);
        //Debug::prn();
        $message = \Yii::$app->request->post('message');

        return $this->renderPartial('comment', [
            'message' => $message,
            'avatar' => $profile->avatar_little,
        ]);
    }

    public function getComments($vk_comments = null, $comments = null)
    {
        $comment_result =[];
        if($vk_comments)
        {
            foreach ($vk_comments as $comment)
            {
                $comment_result[] = [
                    'username' => $comment->author->first_name.' '.$comment->author->last_name,
                    'avatar' => $comment->author->photo,
                    'text' => $comment->text,
                ];
            }
        }

        if($comments)
        {
            foreach ($comments as $comment)
            {
                $photo = Profile::find()->select('avatar')->where(['user_id' => $comment->user_id])
                    ->asArray()
                    ->one();

                $username = User::find()->select('username')->where(['id' => $comment->user_id])
                    ->asArray()
                    ->one();

                $comment_result[] =
                    [
                        'username' => $username['username'],
                        'avatar' => $photo['avatar'],
                        'text' => $comment->content
                    ];
            }
        }

       return $comment_result;
    }

    public function commentsItem($model)
    {
        if(is_array($model))
        {
            foreach ($model as $item)
            {
                $comments = Comments::find()->where(['post_id' => $item->id])
                    ->andWhere(['post_type' => 'vk_post'])
                    ->andWhere(['published' => 1])
                    ->all();

                if($item->comment_status != 0)
                {
                    if(!empty($comments) && !empty($item->comments))
                    {
                        $comment[$item->id] = $this->getComments($item->comments, $comments);
                    }elseif (!empty($item->comments))
                    {
                        $comment[$item->id] =  $this->getComments($item->comments);
                    }else $comment[$item->id] =  $this->getComments(null, $comments);
                }

            }
        }

        return $comment;
    }
}
