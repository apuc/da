<?php

namespace frontend\modules\consulting\controllers;

use common\classes\Debug;
use common\models\db\CategoryFaq;
use common\models\db\CategoryPostsConsulting;
use common\models\db\CategoryPostsDigest;
use common\models\db\Company;
use common\models\db\Consulting;
use common\models\db\Faq;
use common\models\db\KeyValue;
use common\models\db\Likes;
use common\models\db\PostsConsulting;
use common\models\db\PostsDigest;
use frontend\modules\consulting\models\CategoryPosts;
use Yii;
use yii\data\SqlDataProvider;
use yii\db\Connection;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

class ConsultingController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $consultingSlider = Consulting::find()
            ->where(['main_slider' => 1])
            ->all();

        return $this->render('index',
            [
                'consultingsSlider' => $consultingSlider,
                'meta_title' => KeyValue::findOne(['key' => 'consulting_page_meta_title'])->value,
                'meta_descr' => KeyValue::findOne(['key' => 'consulting_page_meta_descr'])->value,
            ]);
    }

    public function actionView()
    {
        $request = Yii::$app->request;

        $consulting = Consulting::find()->where(['slug' => $request->get('slug')])->with('company')->one();
        if (empty($consulting)) {
            return $this->redirect(['site/error']);
        }
        if (empty($consulting->about_company)) {
            if (!empty($consulting->documents)) {
                return $this->redirect(['/consulting/consulting/documents', 'slug' => $request->get('slug')]);
            } elseif (!empty($consulting->posts)) {
                return $this->redirect(['/consulting/consulting/posts', 'slug' => $request->get('slug')]);
            } elseif (!empty($consulting->faq)) {
                return $this->redirect(['/consulting/consulting/faq', 'slug' => $request->get('slug')]);
            } else {
                return $this->redirect(['/consulting/consulting/index']);
            }
        }

        return $this->render('view', ['consulting' => $consulting]);

    }

    public function actionDocuments()
    {
        $request = Yii::$app->request;

        $posts = PostsDigest::find()
            ->where(['type' => $request->get('slug')])
            ->orderBy('dt_update DESC')
            ->with('consulting')
            ->with('categoryPostsDigest')
            ->limit(3)
            ->all();

        $consulting = $posts[0]->consulting;

        return $this->render('view_posts_digest', [
            'posts' => $posts,
            'consulting' => $consulting,
            'postsTitle' => $consulting->title_digest,
            'ajaxCategory' => '',
        ]);

    }

    public function actionDocumentsCategories()
    {
        $request = Yii::$app->request;

        $posts = PostsDigest::find()
            ->where(['`category_posts_digest`.`slug`' => $request->get('slug')])
            ->orderBy('dt_update DESC')
            ->with('consulting')
            ->joinWith('categoryPostsDigest')
            ->limit(3)
            ->all();

        $consulting = $posts[0]->consulting;

        return $this->render('view_posts_digest', [
            'posts' => $posts,
            'consulting' => $consulting,
            'postsTitle' => $consulting->title_digest,
            'ajaxCategory' => $request->get('slug'),

        ]);

    }

    public function actionPosts()
    {
        $request = Yii::$app->request;

        $posts = PostsConsulting::find()
            ->where(['type' => $request->get('slug')])
            ->orderBy('dt_update DESC')
            ->with('consulting')
            ->with('categoryPostsConsulting')
            ->limit(3)
            ->all();

        $consulting = $posts[0]->consulting;


        return $this->render('view_posts', [
            'posts' => $posts,
            'consulting' => $consulting,
            'postsTitle' => 'Статьи',
            'ajaxCategory' => '',
        ]);

    }

    public function actionPostsCategories()
    {
        $request = Yii::$app->request;

        $posts = PostsConsulting::find()
            ->where(['`category_posts_consulting`.`slug`' => $request->get('slug')])
            ->orderBy('dt_update DESC')
            ->with('consulting')
            ->joinWith('categoryPostsConsulting')
            ->limit(3)
            ->all();

        $consulting = $posts[0]->consulting;

        return $this->render('view_posts', [
            'posts' => $posts,
            'consulting' => $consulting,
            'postsTitle' => $posts[0]->categoryPostsConsulting->title,
            'ajaxCategory' => $request->get('slug'),
        ]);

    }

    public function actionFaq()
    {
        $request = Yii::$app->request;

        $posts = Faq::find()
            ->where(['type' => $request->get('slug')])
            ->orderBy('dt_update DESC')
            ->with('consulting')
            ->with('category')
            ->limit(3)
            ->all();

        $consulting = $posts[0]->consulting;

        return $this->render('view_faq', [
            'posts' => $posts,
            'consulting' => $consulting,
            'postsTitle' => 'Вопрос / ответ',
            'ajaxCategory' => '',
        ]);

    }

    public function actionFaqCategories()
    {
        $request = Yii::$app->request;

        $posts = Faq::find()
            ->where(['`category_faq`.`slug`' => $request->get('slug')])
            ->orderBy('dt_update DESC')
            ->with('consulting')
            ->joinWith('category')
            ->limit(3)
            ->all();

        $consulting = $posts[0]->consulting;

        return $this->render('view_faq', [
            'posts' => $posts,
            'consulting' => $consulting,
            'postsTitle' => $posts[0]->categoryPostsConsulting->title,
            'ajaxCategory' => $request->get('slug'),
        ]);

    }

}
