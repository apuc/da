<?php

namespace frontend\modules\ajax\controllers;

use common\classes\Debug;
use common\models\db\Answers;
use common\models\db\Comments;
use common\models\db\Contacting;
use common\models\db\Faq;
use common\models\db\PossibleAnswers;
use common\models\db\PostsConsulting;
use common\models\db\PostsDigest;
use common\models\db\Question;
use common\models\db\Subscribe;
use frontend\widgets\Poll;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `ajax` module
 */
class AjaxController extends Controller
{

    public function actionSend_poll()
    {
        if ($_POST) {
            $user = 0;
            $user_ip = Yii::$app->request->userIP;
            if (!Yii::$app->user->isGuest) {
                $user = Yii::$app->user->id;
            }

            $answer = PossibleAnswers::find()
                ->where([
                    'id' => $_POST['answer'],
                ])
                ->one();
            $already_poll = Answers::find()
                ->where([
                    'user_ip' => $user_ip,
                    'question_id' => $answer->question,
                ])
                ->one();
            if (empty($already_poll)) {

                $vote = new Answers();
                $vote->question_id = $answer->question;
                $vote->possible_answers_id = $answer->id;
                $vote->user_id = $user;
                $vote->user_ip = $user_ip;
                $vote->dt_add = time();

                $vote->save();

                echo Poll::widget();

            }
        }
    }

    public function actionGet_more_comments()
    {
        if ($_POST) {
            $request = Yii::$app->request->post();
            $comments = Comments::find()
                ->where([
                    'post_type' => $request['post_type'],
                    'post_id' => $request['post_id'],
                ])
                ->andWhere(['<', 'dt_add', $request['date']])
                ->orderBy('dt_add DESC')
                ->offset($request['count'])
                ->limit($request['limit'])
                ->all();

            echo $this->renderPartial('_comments',
                ['comments' => $comments]
            );
        }
    }

    public function actionAdd_comment()
    {
        if ($_POST) {

            $request = Yii::$app->request->post();
            $current_user = Yii::$app->user->id;
            $new_comment = new Comments();
            $new_comment->post_type = $request['post_type'];
            $new_comment->post_id = $request['post_id'];
            $new_comment->user_id = $current_user;
            $new_comment->content = $request['content'];
            $new_comment->dt_add = time();

            $new_comment->save();

            // return $this->redirect();

//            echo $this->renderPartial( '_comments',
//                [
//                    'comments' => Comments::find()
//                                          ->where( [ 'id' => $new_comment->id ] )
//                                          ->limit( 1 )
//                                          ->one()
//                ]
//            );

        }
    }

    public function actionMoreFaq()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $lastFaq = Faq::find()
                ->orderBy('id DESC')
                ->offset($request->post()['offset'])
                ->limit(3)
                ->with('consulting')
                ->all();

            return $this->renderPartial('faq', ['lastFaq' => $lastFaq]);

        }
        die();
    }

    public function actionConsultingMorePosts()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            switch ($request->post('post-type')) {

                case 'digest':

                    $posts = PostsDigest::find()
                        ->where(['`posts_digest`.`type`' => $request->post('type')])
                        ->orderBy('dt_update DESC')
                        ->with('consulting')
                        ->joinWith('categoryPostsDigest')
                        ->offset($request->post('offset'))
                        ->limit(3);

                    if (!empty($request->post('category'))) {
                        $posts = $posts->where(['`category_posts_digest`.`slug`' => $request->post('category')]);
                    }

                    return $this->renderPartial('consulting_post_digest', ['posts' => $posts->all()]);

                case 'posts':

                    $posts = PostsConsulting::find()
                        ->where(['`posts_consulting`.`type`' => $request->post('type')])
                        ->orderBy('dt_update DESC')
                        ->with('consulting')
                        ->joinWith('categoryPostsConsulting')
                        ->offset($request->post('offset'))
                        ->limit(3);

                    if (!empty($request->post('category'))) {
                        $posts = $posts->where(['`category_posts_consulting`.`slug`' => $request->post('category')]);
                    }

                    return $this->renderPartial('consulting_post', ['posts' => $posts->all()]);

                case 'faq':

                    $posts = Faq::find()
                        ->where(['`faq`.`type`' => $request->post('type')])
                        ->orderBy('dt_update DESC')
                        ->with('consulting')
                        ->joinWith('category')
                        ->offset($request->post('offset'))
                        ->limit(3);

                    if (!empty($request->post('category'))) {
                        $posts = $posts->where(['`category_faq`.`slug`' => $request->post('category')]);
                    }

                    return $this->renderPartial('consulting_faq', ['posts' => $posts->all()]);
            }
        }
    }

    public function actionAddComment()
    {
        if (Yii::$app->request->isPost) {
            $comment = new Comments();
            $comment->post_type = Yii::$app->request->post('post_type');
            $comment->post_id = Yii::$app->request->post('post_id');
            $comment->user_id = Yii::$app->user->id;
            $comment->content = Yii::$app->request->post('comment');
            $comment->dt_add = time();
            $comment->parent_id = Yii::$app->request->post('parent_id');

            $comment->save();

            return $this->renderPartial('comments-success');

        }

    }

    public function actionAddContacting()
    {

        if (Yii::$app->request->isPost) {

            $newContacting = new Contacting();
            $newContacting->user_id = (!Yii::$app->user->isGuest) ? Yii::$app->user->id : null;
            $newContacting->type = 'question';
            $newContacting->content = Yii::$app->request->post('content');

            $newContacting->save();

        }

    }

    public function actionSubscribe()
    {
        if (Yii::$app->request->isGet) {
            $subscribe = new Subscribe();
            $subscribe->dt_add = time();
            $subscribe->email = Yii::$app->request->get('email');
            $subscribe->save();
        }
    }

}
