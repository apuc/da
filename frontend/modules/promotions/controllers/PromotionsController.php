<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.07.2017
 * Time: 13:20
 */

namespace frontend\modules\promotions\controllers;

use common\classes\Debug;
use common\models\db\Comments;
use frontend\controllers\MainWebController;
use frontend\modules\promotions\models\Stock;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class PromotionsController extends MainWebController
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

    public function behaviors()
    {
        return array_merge([
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['index', 'view', 'update-view', 'read-more-stock'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ],
            parent::behaviors()
        );
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $request = '';
        $isReadMore = true;
        $step = 9;
        $stocks = Stock::find()
            ->where(['status' => 0])
            ->orderBy('dt_update DESC')
            ->limit($step)
            ->with('company')
            ->all();
        $sumStocks = Stock::find()
            ->where(['status' => 0])
            ->count();
        $placeStock = [2, 6, 7];

        $post = Yii::$app->request->post();
        if ($post) {
            if (!empty($post['search'])) {
                $stocks = Stock::find()
                    ->where(['status' => 0])
                    ->andFilterWhere(['like', 'title', $post['search']])
                    ->all();
                $isReadMore = false;
                $request = '"' . $post['search'] . '"';
            }
            if (!empty($post['date'])) {
                $stocks = Stock::find()
                    ->where(['status' => 0])
                    ->andWhere(['<=', "dt_event", $post['date']])
                    ->andWhere(['>=', "dt_event_end", $post['date']])
                    ->all();
                $isReadMore = false;
                $request = '"' . $post['date'] . '"';
            }
        }
        return $this->render('index', [
            'stocks' => $stocks,
            'sumStocks' => $sumStocks,
            'step' => $step,
            'isReadMore' => $isReadMore,
            'placeStock' => $placeStock,
            'request' => $request,

        ]);
    }

    /**
     * @return string
     */
    public function actionReadMoreStock()
    {
        $step = 9;
        $request = Yii::$app->request->post();
        $stocks = Stock::find()
            ->where(['status' => 0])
            ->orderBy('dt_update DESC')
            ->offset($request['page'] * $step)
            ->limit($step)
            ->with('company')
            ->all();
        $placeStock = [2, 6, 7];
        return $this->renderPartial('read-more', [
            'stocks' => $stocks,
            'placeStock' => $placeStock
        ]);
    }

    public function actionUpdateView()
    {
        Stock::updateAllCounters(['view' => 1], ['id' => Yii::$app->request->post('id')]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout = "personal_area";
        $model = new Stock();
        $beforeCreate = $model->beforeCreate();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = 1;
            $model->user_id = Yii::$app->user->id;

            if ($_FILES['Stock']['name']) {

                $upphoto = new \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstanceByName('Stock');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['Stock']['name'];
            }

            $model->save();

            Yii::$app->session->setFlash('success', 'Ваша акция успешно добавлена. После прохождения модерации она будет опубликована.');
            return $this->redirect(['/personal_area/user-promotions']);
        } else {

            return $this->render('create', [
                'model' => $model,
                'beforeCreate' => $beforeCreate
            ]);
        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $this->layout = 'personal_area';
        $model = $this->findModel($id);
        $beforeCreate = $model->beforeCreate();
        if (!array_key_exists($model->company_id, $beforeCreate)) {
            $beforeCreate[$model->company_id] = 1;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = 1;
            $model->user_id = Yii::$app->user->id;

            if ($_FILES['Stock']['name']) {
                $upphoto = new \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstanceByName('Stock');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();

                $model->photo = '/' . $loc . $_FILES['Stock']['name'];
            } else {
                $model->photo = $_POST['Stock']['photo'];
            }

            $model->save();

            Yii::$app->session->setFlash('success', 'Ваша акция успешно отредактирована. После прохождения модерации она будет опубликована.');
            return $this->redirect(['/personal_area/user-promotions']);
        } else {

            return $this->render('update', [
                'model' => $model,
                'beforeCreate' => $beforeCreate,
            ]);
        }
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model) {
            $model->status = 2;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Акция успешно удалена');
            } else
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
        } else  Yii::$app->session->setFlash('error', 'Такой акции не существует');

        return $this->redirect('/personal_area/user-promotions');

    }


    public function actionView($slug)
    {
        $model = Stock::find()->with(['company', 'comments'])->where(['slug' => $slug])->one();
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->updateAllCounters(['view' => 1], ['id' => $model->id]);
        $phones = $model->company->allPhones;
        $stocks = Stock::find()
            ->where(['status' => 0])
            ->andWhere(['!=', 'slug', $slug])
            ->orderBy('dt_update DESC')
            ->limit(9)
            ->with('company')
            ->all();
        return $this->render('view', [
            'model' => $model,
            'phones' => $phones,
            'stocks' => $stocks,
        ]);
    }

    /**
     * @param $id
     * @return null|static|Stock
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddComment()
    {
        $request = Yii::$app->request->post();
        $feedback = new Comments();
        $feedback->post_type = 'promotions';
        $feedback->post_id = $request['id'];
        $feedback->user_id = Yii::$app->user->id;
        $feedback->content = $request['text'];
        $feedback->dt_add = time();
        $feedback->parent_id = 0;
        $feedback->moder_checked = 0;
        $feedback->published = 1;
        $feedback->verified = 1;
        $feedback->save();
    }
}