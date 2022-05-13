<?php
namespace frontend\modules\missing_person\controllers;

use frontend\modules\missing_person\models\MissingPerson;
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
     * @return void
     */
    public function actionCreate(Request $request)
    {
        var_dump($request->getQueryParams());die;
    }
}