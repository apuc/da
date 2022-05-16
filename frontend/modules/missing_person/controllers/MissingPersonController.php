<?php

namespace frontend\modules\missing_person\controllers;

use backend\modules\currency\controllers\CurrencyRateController;
use frontend\modules\missing_person\models\MissingPerson;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Request;

class MissingPersonController extends Controller
{
    const FIVE_YEARS = 157766400;
    const YEARS_18 = 567993600;

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
    public function actionIndex(Request $request): string
    {
        return $this->render('index', [
            'records' => MissingPerson::find()->all(),
        ]);
    }

    /**
     * @return string
     */
    public function actionSearch(Request $request): string
    {
        $data = $request->getQueryParams();
        echo "<pre>";
        var_dump($data);
        var_dump((int)$data['age_category_id']);
        die;
        $query = (new Query())
            ->select()
            ->from('missing_person');

        if (isset($data['age_category_id']) && strlen($data['age_category_id']) > 0){
            $yo18 = 1;
            switch ((int)$data['age_category_id']) {
                case 1:
                    $query->where(['<','date_of_birth', time() - self::FIVE_YEARS]);
                    break;
                case 2:
                    $query->where(['<', 'date_of_birth', time() - self::FIVE_YEARS])
                        ->andWhere(['>', 'date_of_birth', time() - self::YEARS_18]);
                    break;
                case 3:
                    $query->where(['<', 'date_of_birth', time() - self::YEARS_18]);
                    break;
                default:
                    break;
            }
        }

        if (isset($data['city_id']) && strlen($data['city_id']) > 0){
            $query->andWhere(['city_id' => (int)$data['city_id']]);
        }



            return $this->render('index', [
            'records' => $query->all(),
        ]);
    }

    /**
     * @param Request $request
     * @return string
     * @throws InvalidConfigException
     */
    public function actionCreate(Request $request): string
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