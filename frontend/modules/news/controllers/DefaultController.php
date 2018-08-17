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
use yii\web\NotFoundHttpException;

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
    /*
     * Renders the index view for the module
     * @return string
     */
   /* public function actionIndex()
    {
        return $this->render('index', [
            'news' => News::find()->where(['lang_id' => Lang::getCurrent()['id']])->all(),
        ]);
    }*/

    public function actionView()
    {
        $useReg = UserFunction::getRegionUser();
        $request = Yii::$app->request->get();

        if (empty($request['slug'])) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $new = \frontend\modules\news\models\News::find()
            ->where(['`news`.`slug`' => $request['slug']])
            ->one();


        if (empty($new)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if(UserFunction::getPermissionUser() == false){
            if($new['status'] != '0'){
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }


        $countComments = Comments::find()
            ->where([
                'post_id' => $new->id,
                'post_type' => 'news',
                'published' => 1
            ])
            ->count();

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

        $new_title = strip_tags($new->title);
        $new_title = preg_replace("/\s{2,}/", " ", $new_title);
        $new_title = str_replace('"', "&quot;", $new_title);

        $count_symbols = 400 - 48 - 100 - strlen($new_title);
        $new_content = strip_tags($new->content);
        $new_content = preg_replace("/\s{2,}/", " ", $new_content);

        $new_content = mb_substr($new_content, 0, $count_symbols) . '...';

        $readTheSameQuery = News::find()
            ->joinWith('categoryNewsRelations')
            ->where([
                '`category_news_relations`.`cat_id`' => isset($category->id) ? $category->id : 0,
                'status' => 0,
                'exclude_popular' => 0
            ]);
        if($useReg != -1){
            $readTheSameQuery->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");

        }
        $readTheSame = $readTheSameQuery->andWhere(['>=', 'dt_public', (string)(time() - 86400 * Yii::$app->params['countDayReadTheSame'])])
            ->andWhere(['<=', 'dt_public', time()])
            ->andWhere(['!=', '`news`.`id`', $new->id])
            ->orderBy('rand()')
            ->addOrderBy('dt_public DESC')
            ->limit(6)
            ->all();

        return $this->render('view', [
            'model' => $new,
            'likes' => $likes,
            'category' => $category,
            'countComments' => $countComments,
            'newTitle' => $new_title,
            'newContent' => $new_content,
            'readTheSame' => $readTheSame,
            'useReg' => $useReg,
        ]);
    }


    public function actionViewAmp()
    {
        $useReg = UserFunction::getRegionUser();
        $request = Yii::$app->request->get();

        $new = \frontend\modules\news\models\News::find()
            ->where(['`news`.`slug`' => $request['slug']])
            ->one();

        if (empty($new)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if(UserFunction::getPermissionUser() == false){
            if($new['status'] != '0'){
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }


        $countComments = Comments::find()
            ->where([
                'post_id' => $new->id,
                'post_type' => 'news',
                'published' => 1
            ])
            ->count();

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

        $new_title = strip_tags($new->title);
        $new_title = preg_replace("/\s{2,}/", " ", $new_title);
        $new_title = str_replace('"', "&quot;", $new_title);

        $count_symbols = 400 - 48 - 100 - strlen($new_title);
        $new_content = strip_tags($new->content);
        $new_content = preg_replace("/\s{2,}/", " ", $new_content);

        $new_content = mb_substr($new_content, 0, $count_symbols) . '...';

        $readTheSameQuery = News::find()
            ->joinWith('categoryNewsRelations')
            ->where([
                'status' => 0,
                'exclude_popular' => 0
            ]);
        if($category){
            $readTheSameQuery->andWhere(['`category_news_relations`.`cat_id`' => $category->id]);
        }
        if($useReg != -1){
            $readTheSameQuery->andWhere("(`region_id` IS NULL OR `region_id`=$useReg)");

        }

        return $this->renderPartial('view-amp', [
            'model' => $new,
            'likes' => $likes,
            'category' => $category,
            'countComments' => $countComments,
            'newTitle' => $new_title,
            'newContent' => $new_content,
            'useReg' => $useReg,
        ]);
    }



    public function actionSet_dt_public()
    {
        $news = News::find()->where(['dt_public' => null])->all();

        foreach ($news as $new) {
            News::updateAll(['dt_public' => $new->dt_add], ['id' => $new->id]);
        }
    }
}
