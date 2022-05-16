<?php

namespace frontend\modules\missing_person\controllers;

use frontend\modules\missing_person\models\MissingPerson;
use yii\base\InvalidConfigException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Request;

class MissingPersonController extends Controller
{
    function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['POST'],
                ],
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $records = MissingPerson::find()->all();

        return $this->render('index', [
            'records' => $records,
        ]);
    }

    /**
     * @param Request $request
     * @return string
     * @throws InvalidConfigException
     */
    public function actionCreate(Request $request)
    {
        $data = $request->getBodyParams();

        if (!(isset($data['date_of_birth'])
            && isset($data['city_id'])
            && isset($data['FIO'])
            && isset($data['additional_info'])
        )) {
            \Yii::$app->response->statusCode = 400;
            return 'Missing requested parameters';
        }

        $birthDay = strtotime($data['date_of_birth']);

        if (MissingPerson::findOne([
            'date_of_birth' => $birthDay,
            'FIO' => $data['FIO'],
            'city_id' => $data['city_id'],
        ])) {
            \Yii::$app->response->statusCode = 400;
            return 'Такой человек уже есть в базе';
        }

        $person = new MissingPerson();
        $person->city_id = $data['city_id'];
        $person->FIO = $data['FIO'];
        $person->date_of_birth = $birthDay;
        $person->additional_info = $data['additional_info'];
        $person->save();

        return 'success';
    }
}