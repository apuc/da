<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 24.07.2017
 * Time: 13:20
 */

namespace frontend\modules\promotions\controllers;

use common\classes\Debug;
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
                    /*
                    [
                        'actions' => [0],
                        'allow' => true,
                        'roles' => ['?'],
                    ],*/
                ],
            ],
        ];
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


    public function actionView($id)
    {
        $model = Stock::findOne($id);

        return $this->render('view', ['model' => $model]);
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