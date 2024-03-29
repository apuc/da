<?php

namespace frontend\modules\missing_person\controllers;

use backend\modules\currency\controllers\CurrencyRateController;
use common\models\db\GeobaseCity;
use frontend\controllers\MainWebController;
use frontend\modules\missing_person\models\MissingPerson;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Query;
use yii\db\QueryBuilder;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Request;

class MissingPersonController extends MainWebController
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
        return array_merge([
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET'],
                    'create' => ['POST'],
                    'search' => ['GET'],
                    'page' => ['GET'],
                ],
            ]
        ],
            parent::behaviors()
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function actionIndex(Request $request): string
    {
        return $this->render('index', [
            'records' => MissingPerson::find()->where(['moderated' => 1])->limit(self::PER_PAGE)->all(),
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

        $records = MissingPerson::find()->where(['moderated' => 1])->offset($offset)->limit(self::PER_PAGE)->all();

        foreach ($records as $key => $record) {
            $records[$key] = $record->toArray();
            $records[$key]['city_name'] = isset($record['city_id']) ? GeobaseCity::findOne($record['city_id'])->name : '—';
            $records[$key]['date_of_birth'] = date('d.m.Y', $record['date_of_birth']);
            $records[$key]['additional_info'] = $record['additional_info'] ?? '—';
        }

        return Json::encode($records);
    }

    /**
     * @param Request $request
     */
    public function actionSearch(Request $request): string
    {
        $redirectToIndex = true;

        $data = $request->getQueryParams();

        $query = (new Query())
            ->select('*')
            ->from('missing_person')
            ->where(['moderated' => 1]);

        if (isset($data['age_category_id']) && strlen($data['age_category_id']) > 0) {
            $redirectToIndex = false;

            switch ((int)$data['age_category_id']) {
                case 1:
                    $query->where(['>', 'date_of_birth', time() - self::FIVE_YEARS]);
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
            $redirectToIndex = false;
            $query->andWhere(['city_id' => (int)$data['city_id']]);
        }

        if (isset($data['fio']) && strlen($data['fio']) > 0) {
            $redirectToIndex = false;
            $query->andWhere(['like', 'fio', $data['fio']]);
        }

        if ($redirectToIndex) $this->redirect('/missing-person');

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
            && isset($data['fio'])
            && isset($data['_phrase'])
            && isset($data['captcha'])
            && isset($data['additional_info'])
        )) {
            \Yii::$app->response->statusCode = 400;
            return 'Missing requested parameters';
        } elseif (strtolower($data['captcha']) != strtolower($data['_phrase']))
        {
            \Yii::$app->response->statusCode = 400;
            return 'Invalid captcha';
        }

        $birthDay = strtotime($data['date_of_birth']);

        if (MissingPerson::findOne([
            'date_of_birth' => $birthDay,
            'fio' => $data['fio'],
            'city_id' => $data['city_id'],
        ])) {
            \Yii::$app->response->statusCode = 400;
            return 'Такой человек уже есть в базе';
        }

        $person = new MissingPerson();
        $person->city_id = $data['city_id'];
        $person->user_id = Yii::$app->getUser()->id;
        $person->user_ip = Yii::$app->request->userIP;
        $person->fio = $data['fio'];
        $person->date_of_birth = $birthDay;
        $person->additional_info = $data['additional_info'];
        $person->save();

        return 'success';
    }
}