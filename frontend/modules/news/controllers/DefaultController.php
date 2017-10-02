<?php

namespace frontend\modules\news\controllers;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\CategoryNews;
use common\models\db\CategoryNewsRelations;
use common\models\db\Comments;
use common\models\db\Lang;
use common\models\db\Likes;
use common\models\db\News;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `news` module
 */
class DefaultController extends Controller
{
    public $layout = 'portal_page';

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
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'news' => News::find()->where(['lang_id' => Lang::getCurrent()['id']])->all(),
        ]);
    }

    public function actionView()
    {
        $request = Yii::$app->request->get();
        //$new = News::findOne(['slug' => $request['slug']]);
        $new = \frontend\modules\news\models\News::find()
            ->joinWith('tagss.tagname')
            ->where(['slug' => $request['slug']])
            ->andWhere(['`tags_relation`.`type`' => 'news'])
            ->one();
        //Debug::prn($new);
        if (empty($new)) {
            return $this->redirect(['site/error']);
        }
       // Debug::prn(UserFunction::getPermissionUser());
        if(UserFunction::getPermissionUser() == false){
            if($new['status'] != '0'){
                throw new \yii\web\HttpException(404 ,'Страница не найдена.');
            }
        }


        $countComments = Comments::find()
            ->where([
                'post_type' => 'news',
                'post_id' => $new->id,
                'published' => 1
            ])
            ->count();

        //$tags = explode(',', $new->tags);

        $likes = Likes::find()
            ->where(['post_id' => $new->id, 'post_type' => 'news'])
            ->count();

        $currentUserId = Yii::$app->user->id;

        if (!empty($currentUserId)) {
            $thisUserLike = Likes::find()
                ->where(['post_id' => $new->id, 'post_type' => 'news', 'user_id' => $currentUserId])
                ->count();
        } else {
            $thisUserLike = false;
        }
        $new->updateAllCounters(['views' => 1], ['id' => $new->id]);

        if (!empty(Yii::$app->request->post()['category'])) {
            $category = CategoryNews::findOne(Yii::$app->request->post()['category']);
        } else {
            $category = CategoryNewsRelations::find()
                ->where(['new_id' => $new->id])
                ->orderBy('RAND()')
                ->limit(1)
                ->with('cat')
                ->one();
            if (!empty($category->cat)) {
                $category = $category->cat;
            }
        }

        //for share

        //$new_url = \yii\helpers\Url::base(true) . '/news/' . $new->slug;
        $new_title = strip_tags($new->title);
        $new_title = preg_replace("/\s{2,}/", " ", $new_title);
        $new_title = str_replace('"', "&quot;", $new_title);

        $count_symbols = 400 - 48 - 100 - strlen($new_title);
        $new_content = strip_tags($new->content);
        $new_content = preg_replace("/\s{2,}/", " ", $new_content);

        $new_content = substr($new_content, 0, $count_symbols) . '...';

        $readTheSame = News::find()
            ->joinWith('categoryNewsRelations')
            ->where([
                '`category_news_relations`.`cat_id`' => $category->id,
                'status' => 0,
                'exclude_popular' => 0
            ])
            ->andWhere(['!=', '`news`.`id`', $new->id])
            ->andWhere(['>=', 'dt_public', (string)(time() - 86400 * Yii::$app->params['countDayReadTheSame'])])
            ->andWhere(['<=', 'dt_public', time()])
            ->orderBy('rand()')
            ->addOrderBy('dt_public DESC')
            ->limit(6)
            ->all();


        return $this->render('view', [
            'model' => $new,
            //'tags' => $tags,
            'likes' => $likes,
            'category' => $category,
            'countComments' => $countComments,
            'thisUserLike' => $thisUserLike,
            'newTitle' => $new_title,
            'newContent' => $new_content,
            'readTheSame' => $readTheSame,
        ]);
    }

    public function _actionView()
    {
        $new = News::find()->where(['slug' => $_GET['slug']])->one();
        if (empty($new)) {
            return $this->redirect(['site/error']);
        }
        $new->updateAllCounters(['views' => 1], ['id' => $new->id]);

        $cats_news_ids = ArrayHelper::getColumn(CategoryNewsRelations::find()->where(['new_id' => $new->id])->select('cat_id')->asArray()->all(),
            'cat_id');
        $cats_news = ArrayHelper::getColumn(CategoryNewsRelations::find()->where(['cat_id' => $cats_news_ids])->select('new_id')->asArray()->all(),
            'new_id');
        $related_news = News::find()
            ->where(['id' => $cats_news, 'status' => 0])
            ->andWhere(['!=', 'id', $new->id])
            ->andWhere(['>', 'dt_public', time() - 3600 * 24 * 14])
            ->orderBy(['rand()' => SORT_DESC])
            ->limit(6)
            ->all();

        $most_popular_news = News::find()
            ->andWhere(['>', 'dt_public', time() - 3600 * 24 * 14])
            ->andWhere(['!=', 'id', $new->id])
            ->andWhere(['exclude_popular' => 0, 'status' => 0])
            ->orderBy('views DESC')
            ->limit(6)
            ->all();
        $count_likes = count(Likes::find()
            ->where(['post_type' => 'news', 'post_id' => $new->id])
            ->all());

        $user_set_like = Likes::find()
            ->where([
                'post_type' => 'news',
                'user_id' => Yii::$app->user->id,
                'post_id' => $new->id,
            ])
            ->one();

        if (!empty($new->content)) {
            return $this->render('view', [
                'news' => $new,
                'related_news' => $related_news,
                'most_popular_news' => $most_popular_news,
                'count_likes' => $count_likes,
                'user_set_like' => $user_set_like,
            ]);
        } else {
            return $this->render('view_image', [
                'news' => $new,
                'related_news' => $related_news,
                'most_popular_news' => $most_popular_news,
                'count_likes' => $count_likes,
                'user_set_like' => $user_set_like,
            ]);
        }
    }

    public function actionSet_dt_public()
    {
        $news = News::find()->where(['dt_public' => null])->all();

        foreach ($news as $new) {
            News::updateAll(['dt_public' => $new->dt_add], ['id' => $new->id]);
        }
    }
}
