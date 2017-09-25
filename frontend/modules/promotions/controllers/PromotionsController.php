<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.07.2017
 * Time: 13:20
 */

namespace frontend\modules\promotions\controllers;

use common\classes\Debug;
use common\models\db\Phones;
use common\models\db\ServicesCompanyRelations;
use frontend\modules\company\models\Company;
use frontend\modules\promotions\models\Stock;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

class PromotionsController extends Controller
{
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $stock = Stock::find()
            ->where(['status' => 0])
            ->orderBy('dt_update DESC')
            ->limit(9)
            ->with('company')
            ->all();
        $placeStock = [2, 6, 7];
        return $this->render('index', [
            'stock' => $stock,
            'placeStock' => $placeStock
        ]);
    }

    public function actionReadMoreStock()
    {
        $request = Yii::$app->request->post();

        $stock = Stock::find()
            ->where(['status' => 0])
            ->orderBy('dt_update DESC')
            ->offset($request['page'] * 9)
            ->limit(9)
            ->with('company')
            ->all();
        $placeStock = [2, 6, 7];
        return $this->renderPartial('read-more', [
            'stock' => $stock,
            'placeStock' => $placeStock
        ]);
    }

    public function actionUpdateView()
    {
        //Debug::prn(Yii::$app->request->post('id'));
        Stock::updateAllCounters([ 'view' => 1 ], [ 'id' => Yii::$app->request->post('id') ]);

    }

    public function actionCreate()
    {
        $this->layout = "personal_area";
        $model = New Stock();
        $beforeCreate = $model->beforeCreate();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = 1;
            $model->user_id = Yii::$app->user->id;

            if ($_FILES['Stock']['name']['photo']) {

                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();
                $model->photo = '/' . $loc . $_FILES['Stock']['name']['photo'];
            }

            $model->save();

            Yii::$app->session->setFlash('success','Ваша акция успешно добавлена. После прохождения модерации она будет опубликована.');
            return $this->redirect(['/personal_area/user-promotions']);
        }

        else {

            /*if(empty($beforeCreate)){
                Debug::prn($beforeCreate);
            }*/

            return $this->render('create', [
                'model' => $model,
                'beforeCreate' => $beforeCreate
            ]);
        }

    }

    public function actionUpdate($id)
    {
        $this->layout = 'personal_area';
        $model = $this->findModel($id);
        $beforeCreate = $model->beforeCreate();
        if(!$beforeCreate[$model->company_id])
        {
            $beforeCreate[$model->company_id] = 1;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = 1;
            $model->user_id = Yii::$app->user->id;

            if ($_FILES['Stock']['name']['photo']) {
                $upphoto = New \common\models\UploadPhoto();
                $upphoto->imageFile = UploadedFile::getInstance($model, 'photo');
                $loc = 'media/upload/userphotos/' . date('dmY') . '/';
                if (!is_dir($loc)) {
                    mkdir($loc);
                }
                $upphoto->location = $loc;
                $upphoto->upload();

                $model->photo = '/' . $loc . $_FILES['Stock']['name']['photo'];
            }else{
               $model->photo = $_POST['photo'];
            }

            $model->save();

            Yii::$app->session->setFlash('success','Ваша акция успешно отредактирована. После прохождения модерации она будет опубликована.');
            return $this->redirect(['/personal_area/user-promotions']);
        }

        else {

            return $this->render('update', [
                'model' => $model,
                'beforeCreate' => $beforeCreate,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model)
        {
            $model->status = 2;

            if ($model->save())
            {
                Yii::$app->session->setFlash('success','Акция успешно удалена');
            }else
                Yii::$app->session->setFlash('error','Произошла ошибка');
        }else  Yii::$app->session->setFlash('error','Такой акции не существует');

        return $this->redirect('/personal_area/user-promotions');

    }


    public function actionView($slug)
    {
        $model = Stock::find()->with('company')->where(['slug' => $slug])->one();
        $phones = Phones::find()->where(['company_id' => $model->company['id']])->all();
       // Debug::prn($slug);
        return $this->render('view', [
            'model' => $model,
            'phones' => $phones
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}