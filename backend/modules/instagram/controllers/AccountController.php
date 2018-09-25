<?php

namespace backend\modules\instagram\controllers;

use Yii;
use backend\modules\instagram\models\InstAccounts;
use backend\modules\instagram\models\InstAccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\db\InstPhoto;


class AccountController extends Controller
{
    private $token = "3896860838.8875f5c.34f347c271124eb6a007992fcd397303";
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new InstAccountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    public function actionParse($id)
    {

        $url = "https://api.instagram.com/v1/users/" . $id . "/media/recent?access_token=" . $this->token;

        $photos = json_decode($this->InstApi($url));

        foreach ($photos->data as $inst_photo)
        {


           if(!InstPhoto::find()->where(['inst_id' => $inst_photo->id])->one()){
                $photo = new InstPhoto();

                $photo->inst_id = $inst_photo->id;
                $photo->photo_url = $inst_photo->images->standard_resolution->url;
                $photo->author_name = $inst_photo->user->username;
                $photo->author_img = $inst_photo->user->profile_picture;
                $photo->pub_date = $this->dateParse($inst_photo->created_time);
                $photo->status = 0;
                $photo->caption = ($inst_photo->caption!=null) ? $inst_photo->caption->text : null;
                $photo->save();

            }
        }

        Yii::$app->session->setFlash('success', 'Данные получены');
        return $this->redirect("index");

    }


    private function dateParse($time)
    {
        $monthes = array(
            1 => 'янв', 2 => 'фев', 3 => 'мар', 4 => 'апр',
            5 => 'мая', 6 => 'июн', 7 => 'июл', 8 => 'авг',
            9 => 'сен', 10 => 'окт', 11 => 'ноя', 12 => 'дек'
        );

        return gmdate("j", $time)." ".
            $monthes[gmdate("n", $time)]." ".
            gmdate("Y", $time);
    }

    public function actionCreate()
    {
        $model = new InstAccounts();



        if (Yii::$app->request->post())
        {
             $model->load(Yii::$app->request->post());

             if($model->validate())
             {
                 $url = "https://www.instagram.com/".$model->username."/";

                 $html = $this->InstApi($url);
                 $isUserExists = preg_match('/profilePage_([0-9])*/', $html, $matches);

                 if($isUserExists !=0)
                 {
                     $id = explode("_",$matches[0])[1];

                     $url = "https://api.instagram.com/v1/users/".$id."/?access_token=$this->token";
                     $user_info = json_decode($this->InstApi($url));
                      //var_dump($user_info); die();

                     if(!isset($user_info->meta))
                     {
                         $model->account_id = $id;
                         $model->username = $user_info->data->username;
                         $model->profile_img = $user_info->data->profile_picture;
                         $model->iprofile_link = "https://www.instagram.com/".$model->username;
                         $model->save();
                     }
                     else
                     {
                         Yii::$app->session->setFlash('error', $user_info->meta->error_message);
                         return $this->redirect("/secure/instagram/account");
                     }

                 }
                 else
                 {
                     Yii::$app->session->setFlash('error', 'Пользователь с таким именем не существует!');
                     return $this->redirect("/secure/instagram/account");
                 }

             }

             return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    private function InstApi($url)
    {

        $instagram_cnct = curl_init(); // инициализация cURL подключения
        curl_setopt( $instagram_cnct, CURLOPT_URL, $url); // подключаемся
        curl_setopt( $instagram_cnct, CURLOPT_RETURNTRANSFER, 1 ); // просим вернуть результат
        curl_setopt( $instagram_cnct, CURLOPT_TIMEOUT, 15 );
        $result = curl_exec( $instagram_cnct  ); // получаем и декодируем данные из JSON
        curl_close( $instagram_cnct );

        return $result;
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = InstAccounts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
