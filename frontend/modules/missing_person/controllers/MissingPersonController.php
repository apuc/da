<?php

namespace frontend\modules\missing_person\controllers;

use backend\modules\currency\controllers\CurrencyRateController;
use common\models\db\GeobaseCity;
use frontend\modules\missing_person\models\MissingPerson;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;

class MissingPersonController extends Controller
{
    const FIVE_YEARS = 157766400;
    const YEARS_18 = 567993600;
    const PER_PAGE = 50;

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
                    'search' => ['GET'],
                    'page' => ['GET'],
                ],
            ]
        ];
    }

    /**
     * @param Request $request
     * @return string
     */
    public function actionIndex(Request $request): string
    {
        return $this->render('index', [
            'records' => MissingPerson::find()->limit(self::PER_PAGE)->all(),
            'hasMore' => (new Query)->select('*')->from('missing_person')->count() > self::PER_PAGE,
        ]);
    }

    public function actionPage(Request $request)
    {
        $data = $request->getQueryParams();

        if (!isset($data['page'])) {
            \Yii::$app->response->setStatusCode(400);
            return 'Missing page param';
        }
        $offset = (int)$data['page'] * self::PER_PAGE;

        $records = MissingPerson::find()->offset($offset)->limit(self::PER_PAGE)->all();

        foreach ($records as $key => $record) {
            $records[$key] = $record->toArray();
            $records[$key]['city_name'] = GeobaseCity::findOne($record['city_id'])->name;
        }

        return Json::encode($records);
    }

    /**
     * @return string
     */
    public function actionSearch(Request $request): string
    {
        $data = $request->getQueryParams();

        $query = (new Query())
            ->select('*')
            ->from('missing_person');

        if (isset($data['age_category_id']) && strlen($data['age_category_id']) > 0) {
            $yo18 = 1;
            switch ((int)$data['age_category_id']) {
                case 1:
                    $query->where(['<', 'date_of_birth', time() - self::FIVE_YEARS]);
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

        if (isset($data['city_id']) && strlen($data['city_id']) > 0) {
            $query->andWhere(['city_id' => (int)$data['city_id']]);
        }

        if (isset($data['FIO']) && strlen($data['FIO']) > 0) {
            $query->andWhere(['like', 'FIO', $data['FIO']]);
        }

        return $this->render('search', [
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