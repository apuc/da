<?php

namespace frontend\modules\poster\controllers;

use backend\modules\poster\controllers\PosterController;
use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use common\models\db\Likes;
use common\models\db\Poster;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Default controller for the `poster` module
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

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'view', 'category', 'archive_category', 'single_category', 'single_archive_category', 'updposterdt_event', 'updposterdt_event_end', 'more-interested-in', 'interested-in-posters', 'get-more-poster', 'get-more-kino', 'more-poster', 'archive'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @throws \yii\web\HttpException
     */
    public function actionIndex()
    {
        //return $this->render('index');
        throw new \yii\web\HttpException(404 ,'Страница не найдена.');
    }

    public function actionView($slug)
    {
        $poster = Poster::find()
            ->with('category')
            ->joinWith('tagss.tagname')
            ->where(['slug' => $slug])->one();

        if (empty($poster)) {
            return $this->redirect(['site/error']);
        }
        if($poster['status'] == '1'){
            throw new \yii\web\HttpException(404 ,'Страница не найдена.');
        }

        $likes = Likes::find()
            ->where(['post_id' => $poster->id, 'post_type' => 'poster'])
            ->count();

        if (!empty(Yii::$app->request->post()['category'])) {
            $category = CategoryPoster::findOne(Yii::$app->request->post()['category']);
        } else {
            $category = CategoryPosterRelations::find()
                ->where(['poster_id' => $poster->id])
                ->orderBy('RAND()')
                ->limit(1)
                ->with('category_poster')
                ->one();
        }

        if (!Yii::$app->user->isGuest) {
            $thisUserLike = Likes::find()
                ->where(['post_id' => $poster->id, 'post_type' => 'poster', 'user_id' => Yii::$app->user->id])
                ->count();
        } else {
            $thisUserLike = false;
        }

        $poster->updateAllCounters(['views' => 1], ['id' => $poster->id]);

        return $this->render('view', [
            'model' => $poster,
            'category' => $category->category_poster,
            'likes' => $likes,
            'thisUserLike' => $thisUserLike,
        ]);
    }

    /*public function _actionView($slug)
    {
        $poster = Poster::find()->where(['slug' => $slug])->one();

        if (empty($poster)) {
            return $this->redirect(['site/error']);
        }

        $poster->updateAllCounters(['views' => 1], ['id' => $poster->id]);

        $cats_posters_ids = ArrayHelper::getColumn(CategoryPosterRelations::find()->where(['poster_id' => $poster->id])->select('cat_id')->asArray()->all(),
            'cat_id');
        $cats_posters = ArrayHelper::getColumn(CategoryPosterRelations::find()->where(['cat_id' => $cats_posters_ids])->select('poster_id')->asArray()->all(),
            'poster_id');

        $related_posters = Poster::find()->where(['id' => $cats_posters])->andWhere([
            '!=',
            'id',
            $poster->id,
        ])->andWhere(['>', 'dt_event', time()])->orderBy(['rand()' => SORT_DESC])->limit(6)->all();

        $most_popular_posters = Poster::find()->andWhere(['>', 'dt_event', time()])->andWhere([
            '!=',
            'id',
            $poster->id,
        ])->orderBy('views DESC')->limit(6)->all();

        $count_likes = count(Likes::find()
            ->where(['post_type' => 'posters', 'post_id' => $poster->id])
            ->all());
        $user_set_like = Likes::find()
            ->where([
                'post_type' => 'posters',
                'user_id' => Yii::$app->user->id,
                'post_id' => $poster->id,
            ])
            ->one();

        return $this->render('view', [
            'poster' => $poster,
            'related_posters' => $related_posters,
            'most_popular_posters' => $most_popular_posters,
            'count_likes' => $count_likes,
            'user_set_like' => $user_set_like,
        ]);
    }*/

    public function actionCategory()
    {
       /* $query = \common\models\db\Poster::find()->andWhere([
            '>',
            'dt_event_end',
            time(),
        ])
            ->orderBy('dt_event_end')
        ;
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);*/

        return $this->render('category2', [
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            //'dataProvider' => $dataProvider,
            'meta_title' => KeyValue::findOne(['key' => 'poster_page_meta_title'])->value,
            'meta_descr' => KeyValue::findOne(['key' => 'poster_page_meta_descr'])->value,
        ]);
    }

    public function actionArchive_category()
    {
        $query = \common\models\db\Poster::find()->orderBy('dt_event DESC');
        $dataProvider = new SqlDataProvider([
            'sql' => $query->createCommand()->rawSql,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionSingle_category($slug)
    {
        $cat = CategoryPoster::find()->where(['slug' => $slug])->one();
        $query = CategoryPosterRelations::find()
            ->leftJoin('poster', '`category_poster_relations`.`poster_id` = `poster`.`id`')
            ->orderBy('dt_event')
            ->where(['cat_id' => $cat->id])
            ->andWhere(['>=', 'dt_event_end', time()])
            ->with('poster');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category_single', [
            'slug' => $slug,
            'cat' => $cat,
            'meta_title' => KeyValue::findOne(['key' => 'poster_page_meta_title'])->value,
            'meta_descr' => KeyValue::findOne(['key' => 'poster_page_meta_descr'])->value,
        ]);
    }

    public function actionSingle_archive_category($slug)
    {
        $cat = CategoryPoster::find()->where(['slug' => $slug])->one();
        $query = CategoryPosterRelations::find()
            ->leftJoin('poster', '`category_poster_relations`.`poster_id` = `poster`.`id`')
            ->orderBy('dt_event DESC')
            ->where(['cat_id' => $cat->id])
            ->with('poster');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'totalCount' => (int)$query->count(),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('category', [
            'category' => CategoryPoster::find()->orderBy('id DESC')->all(),
            'dataProvider' => $dataProvider,
        ]);
    }

    public static function actionUpdposterdt_event()
    {

        $posters = Poster::find()->all();
        foreach ($posters as $k) {
            if ($k->dt_event == 0) {
                Poster::updateAll(['dt_event' => $k->dt_add], ['id' => $k->id]);
            }
        }

    }

    public static function actionUpdposterdt_event_end()
    {

        $posters = Poster::find()->all();
        foreach ($posters as $k) {
            if ($k->dt_event_end == 0) {
                Poster::updateAll(['dt_event_end' => $k->dt_event], ['id' => $k->id]);
            }
        }

    }
    // загружаем больше категорий "Вас может заинтересовать"
    public function actionMoreInterestedIn()
    {
        $interestedInPostersJson = KeyValue::findOne(['key' => 'intrested_in_posters']);
        $interestedInPosters = json_decode($interestedInPostersJson->value);

        if (count($interestedInPosters) <= 4) {
            die();
        }

        $moreInterestedPosters = array_slice($interestedInPosters, 4, null, true);

        return $this->renderAjax('more_interested_in', [
            'interestedInPosters' => $moreInterestedPosters,
        ]);
    }
    // показываем события из категории "Вас может заинтересовать"
    public function actionInterestedInPosters()
    {
        $posterID = (int) Yii::$app->request->post('posterID');

        $interestedInPostersJson = KeyValue::findOne(['key' => 'intrested_in_posters']);
        $interestedInPosters = json_decode($interestedInPostersJson->value);

        $posters = Poster::find()
            ->joinWith('categories')
            ->where(['poster.id' => $interestedInPosters[$posterID]->posters])
            ->all();

        return $this->renderPartial('more_kino', [
            'posters' => $posters
        ]);
    }

    public function actionGetMorePoster()
    {
        $step = Yii::$app->request->post('step');
        $poster = Poster::find()
            ->where(['>=', 'dt_event_end', time()])
            ->orderBy('dt_event')
            ->offset($step)
            ->limit(4)
            ->with('categories')
            ->all();

        $data['html'] = $this->renderPartial('more_poster', [
            'posters' => $poster
        ]);
        $data['last'] = count($poster) < 4 ? 1 : 0;
        return json_encode($data);
    }

    public function actionGetMoreKino()
    {
        $step = (int)Yii::$app->request->post('step');

        $step = ($step - 1) * 4;

        $posters = Poster::find()
            ->joinWith('categories')
            /*->where(['<=', 'dt_event_end', time()])*/
            ->andWhere(['>=', 'dt_event_end', time()])
            ->andWhere(['`category_poster`.`slug`' => 'kino'])
            ->orderBy('dt_event ASC')
            ->offset($step)
            ->limit(4)
            ->all();

        $data['html'] = $this->renderPartial('more_kino', [
            'posters' => $posters
        ]);
        $data['last'] = count($posters) < 4 ? 1 : 0;
        return json_encode($data);
    }


    public function actionMorePoster()
    {
        $page = Yii::$app->request->post('page');
        $limit = Yii::$app->request->post('limit');
        $count = Yii::$app->request->post('count');



        $poster = Poster::find()
            ->where(['popular' => 1])
            ->andWhere(['>=', 'dt_event', time()])
            ->orderBy('dt_event ASC')
            ->offset(((int)$page - 1) * $limit)
            ->limit($limit)
            ->with('categories')
            ->all();

        $data['html'] = $this->renderPartial('more_poster_w', [
            'posters' => $poster
        ]);
        $data['last'] = $count - ((int)$page - 1) * $limit <= $limit ? 1 : 0;
        return json_encode($data);
    }

    //Добавление афиши
    public function actionCreate()
    {
        $this->layout = 'personal_area';
        $model = new \backend\modules\poster\models\Poster();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $phone = '';
            foreach ($_POST['mytext'] as $item){
                $phone .= $item . ' ';
            }

            $model->status = 1;
            $model->phone = $phone;
            $model->dt_event = strtotime($model->dt_event);
            $model->dt_event_end = strtotime($model->dt_event_end);
            $model->user_id = Yii::$app->user->id;
            $model->meta_title = $model->title . ' - Афиша на DA-info';
            $model->meta_descr = \yii\helpers\StringHelper::truncate($model->descr, 250) . ' - Афиша на DA-info';

            if ($_FILES['Poster']['name']['photo']) {
                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['Poster']['name']['photo'];
            }

            $model->save();
            foreach ($_POST['cat'] as $cat) {
                $catNewRel = new CategoryPosterRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->poster_id = $model->id;
                $catNewRel->save();
            }
            Yii::$app->session->setFlash('success','Ваша афиша успешно добавлена. После прохождения модерации она будет опубликована.');
            return $this->redirect('/personal_area/default/index');
        } else {

            $categoryPoster = CategoryPoster::find()->all();

            return $this->render('create', [
                'model' => $model,
                'categoryPoster' => $categoryPoster
            ]);
        }
    }

    //Редактирование афиши
    public function actionUpdate($id)
    {

        $this->layout = 'personal_area';
        $model = \backend\modules\poster\models\Poster::find()->where(['id' => $id])->one();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $phone = '';
            foreach ($_POST['mytext'] as $item){
                $phone .= $item . ' ';
            }

            $model->status = 1;
            $model->phone = $phone;
            $model->dt_event = strtotime($model->dt_event);
            $model->dt_event_end = strtotime($model->dt_event_end);
            $model->user_id = Yii::$app->user->id;
            $model->meta_title = $model->title . ' - Афиша на DA-info';
            $model->meta_descr = \yii\helpers\StringHelper::truncate($model->descr, 250) . ' - Афиша на DA-info';

            if (!empty($_FILES['Poster']['name']['photo'])) {
                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['Poster']['name']['photo'];
            }else{
                $model->photo = $_POST['img'];
            }

            $model->save();
            CategoryPosterRelations::deleteAll(['poster_id' => $id]);
            foreach ($_POST['cat'] as $cat) {
                $catNewRel = new CategoryPosterRelations();
                $catNewRel->cat_id = $cat;
                $catNewRel->poster_id = $model->id;
                $catNewRel->save();
            }
            Yii::$app->session->setFlash('success','Ваша афиша успешно измененна. После прохождения модерации она будет опубликована.');
            return $this->redirect('/personal_area/default/index');
        } else {

            $categoryPoster = CategoryPoster::find()->all();
            $categorySelect = CategoryPosterRelations::find()->where(['poster_id' => $id])->all();
            return $this->render('update', [
                'model' => $model,
                'categoryPoster' => $categoryPoster,
                'categorySelect' => $categorySelect
            ]);
        }
    }

    //Удаление афиши (меняем статус на 2)
    public function actionDelete($id)
    {
        Poster::updateAll(['status' => 2], ['id' => $id]);
        Yii::$app->session->setFlash('success','Ваша афиша успешно удалена.');
        return $this->redirect('/personal_area/user-poster');
    }

    public function actionArchive($date)
    {
        $date_time = strtotime($date);
        $model = Poster::find()->where(['>=', 'dt_event_end', $date_time])
            ->andWhere(['<=', 'dt_event', $date_time])
            ->andWhere(['status' => 0])
            ->all();
        //Debug::prn($model);
        return $this->render('archive_poster', ['model' => $model, 'date' => $date]);
    }
}
