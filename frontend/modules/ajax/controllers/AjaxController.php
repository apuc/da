<?php

namespace frontend\modules\ajax\controllers;

use common\classes\Debug;
use common\classes\Folder;
use common\classes\UserFunction;
use common\models\db\Answers;
use common\models\db\CategoryCompany;
use common\models\db\CategoryNews;
use common\models\db\Comments;
use common\models\db\Contacting;
use common\models\db\Faq;
use common\models\db\KeyValue;
use common\models\db\PossibleAnswers;
use common\models\db\PostsConsulting;
use common\models\db\PostsDigest;
use common\models\db\Products;
use common\models\db\ProductsReviews;
use common\models\db\Question;
use common\models\db\SiteError;
use common\models\db\News;
use common\models\db\Subscribe;
use common\models\User;
use frontend\models\user\Profile;
use frontend\modules\company\models\Company;
use frontend\modules\promotions\models\Stock;
use frontend\modules\shop\models\CategoryShop;
use frontend\modules\shop\models\form\QuestionForm;
use frontend\modules\shop\models\form\ReviewsForm;
use frontend\modules\shop\widgets\ReviewsProducts;
use frontend\widgets\Poll;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\imagine\Image;
use yii\web\Controller;

/**
 * Default controller for the `ajax` module
 */
class AjaxController extends Controller
{
    function init()
    {
        parent::init();
    }

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
                    'user_id' => $user,
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
            $comment->published = 1;
            $comment->save();

            $html['successInfo'] = $this->renderPartial('comments-success');
            $html['comments'] = \frontend\widgets\Comments::widget([
                'pageTitle' => 'Комментарии',
                'postType' => $comment->post_type,
                'postId' => Yii::$app->request->post('post_id'),
            ]);

            return json_encode($html);
        }

    }

    public function actionAddContacting()
    {

        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post('name');
            $email = Yii::$app->request->post('email');
            $newContacting = new Contacting();
            if (!Yii::$app->user->isGuest) {
                $user = Profile::findOne(['user_id' => Yii::$app->user->id]);
                $newContacting->user_id = Yii::$app->user->id;
                $newContacting->username = ($user->name) ? $user->name : Yii::$app->user->identity->username;
                $newContacting->email = ($user->public_email) ? $user->public_email : Yii::$app->user->identity->email;
            } elseif ($name && $email) {
                $newContacting->user_id = null;
                $newContacting->username = $name;
                $newContacting->email = $email;
            }
            //$newContacting->user_id = (!Yii::$app->user->isGuest) ? Yii::$app->user->id : null;
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

    public function actionAddCategory()
    {
        $contact = new Contacting();
        $user = User::findById(Yii::$app->request->post('id'));
        $contact->user_id = $user->id;
        $contact->username = $user->username;
        $contact->email = $user->email;
        $contact->content = Yii::$app->request->post('text');
        $contact->type = 'category_request';
        if ($contact->save())
            return 'ok';
        else
            return "error";
    }

    public function actionAddPromotionComment()
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $promo = Stock::findOne($post['promoId']);
            $comment = new Comments();
            $comment->post_type = "promotion";
            $comment->post_id = $post['promoId'];
            $comment->user_id = $post['userId'];
            $comment->content = $post['text'];
            $comment->published = 1;
            $comment->dt_add = time();
            if ($comment->save())
                return $promo->slug;
            else
                return 'error';
        } else return 'error';
    }

    public function actionAddCategorySelect()
    {
        $catId = Yii::$app->request->post('catId');
        // var_dump($catId);
        $catId = explode(',', $catId);
        array_splice($catId, -1);
        $model = new \frontend\modules\news\models\News();
        $query = CategoryNews::find()
            ->where(['lang_id' => 1]);
        foreach ($catId as $item) {
            $query->andWhere(['!=', 'id', $item]);
        }

        $category = $query->all();
        //echo "<br> Categories ajax: <br>";
        // var_dump($category);
        if (!empty($category)) {
            $html = $this->renderAjax('add-select-category', ['category' => $category, 'model' => $model]);
        } else {
            $html = '';
        }

        return $html;
        Debug::prn($html);
    }

    public function actionAddParentCategory()
    {
        $catId = Yii::$app->request->post('catId');
        $model = new Company();

        $html = $this->renderPartial('parent-category', ['catId' => $catId, 'model' => $model]);
        return $html;

    }

    //отправка сообщения об ошибке
    public function actionSendErrorMsg(): bool
    {
        $request = Yii::$app->request->post();
        $errorFeedback = new SiteError();
        $errorFeedback->url = $request['url'];
        $errorFeedback->user_id = $request['user_id'];
        $errorFeedback->msg = $request['text'];

        if (Yii::$app->user->isGuest) {
            $errorFeedback->username = $request['name'];
            $errorFeedback->email = $request['email'];
        } else {
            $errorFeedback->username = UserFunction::getUserName($request['user_id']);
            $errorFeedback->email = Yii::$app->user->identity->email;
        }

        $errorFeedback->dt_add = time();
        $errorFeedback->save();

        if (isset($errorFeedback->id)) {
            return true;
        }
        return false;
    }

    public function actionSendUserMsg(): bool
    {
        //TODO send

        return true;
    }

    public function actionSelectRegion()
    {
        $regId = Yii::$app->request->post('regId');
        if (empty($regId)) {
            $regId = -1;
        }

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'regionId',
            'value' => $regId,
            'expire' => time() + 86400,
        ]));

        Yii::$app->cache->set('show_header_widget', \frontend\widgets\ShowHeader::widget());

        return true;
    }

    public function actionAddReviewsProducts()
    {
        $form_model = new ReviewsForm();
        if (\Yii::$app->request->isAjax && $form_model->load(\Yii::$app->request->post())) {
            $form_model->user_id = Yii::$app->user->id;
            $form_model->dt_add = time();
            $form_model->save();
        }
        return $this->renderPartial('single-review', [
            'item' => $form_model,
        ]);
    }

    public function actionAddQuestionProducts()
    {
        $form_model = new QuestionForm();
        if (\Yii::$app->request->isAjax && $form_model->load(\Yii::$app->request->post())) {

            $form_model->user_id = Yii::$app->user->id;
            $form_model->dt_add = time();
            $form_model->save();
        }
        return $this->renderPartial('single-review', [
            'item' => $form_model,
        ]);

    }

    public function actionGetProductsByCategoryId()
    {
        $dataId = Yii::$app->request->post('ProdId');
        if ($dataId == 0) {
            $jsonCatsKeys = KeyValue::findOne(['key' => 'you_like']);
            $catsKeys = json_decode($jsonCatsKeys->value);
            $products = Products::find()->where(['category_id' => $catsKeys, 'type' => Products::TYPE_PRODUCT])->limit(15)->all();
        } else {
            $products = Products::find()->where(['category_id' => $dataId, 'type' => Products::TYPE_PRODUCT])->limit(15)->all();
        }
        $response = ArrayHelper::toArray($products, [
            'common\models\db\Products' => [
                'id',
                'title',
                'price',
                'new_price',
                'cover',
                'link' => function ($products) {
                    return \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $products->slug]);
                },
                'category' => function ($products) {
                    return $products->category->name;
                },
            ],
        ]);
        return json_encode($response);
    }

    public function actionUploadProductPhoto()
    {
        $dir = '/media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
        $path = Yii::getAlias('@frontend/web' . $dir);
        $folderThumb = new Folder($path . 'thumb/', 0775);
        $folderThumb->create();
        $folderImg = new Folder($path, 0775);
        $folderImg->create()
            ->file($_FILES['file']['tmp_name'])
            ->watermark(Yii::getAlias('@frontend/web/img/logo.png'), 0, 0)
            ->thumbnail($_FILES['file']['name'], ['w' => 426, 'h' => 300], $path . 'thumb/')
            ->save($_FILES['file']['name']);

        return json_encode([
            'img' => $dir . $_FILES['file']['name'],
            'img_thumb' => $dir . 'thumb/' . $_FILES['file']['name'],
        ]);
    }

    public function actionCropImg()
    {
        $post = Yii::$app->request->post();
        $img = Yii::getAlias('@frontend/web' . $post['img']);
        $time = time();

        list($width, $height, $type, $attr) = getimagesize($img); //определяем размер изображения

        $k = $width / 600; // коэфициент размера

        $dir = '/media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
        $path = Yii::getAlias('@frontend/web' . $dir);
        $folderImg = new Folder($path, 0775);
        $folderImg->create()->file($img)->crop($post['w'] * $k, $post['h'] * $k, $post['x'] * $k, $post['y'] * $k)->save('crop_' . $time . '_' . $post['imgName']);
        $post['img'] = $dir . 'crop_' . $time . '_' . $post['imgName'];
        return json_encode($post);
    }

    public function actionGetCategory()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $get = Yii::$app->request->get('parent_id');
        $get = $get ? $get : 0;
        $cat = CategoryCompany::getListByParentId($get);
        return $cat;
    }

}
