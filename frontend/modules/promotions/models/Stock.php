<?php
namespace frontend\modules\promotions\models;
use common\models\db\Likes;
use Yii;
use yii\db\ActiveRecord;
use common\models\db\ServicesCompanyRelations;
use common\models\db\Company;
use common\classes\Debug;
class Stock extends \common\models\db\Stock
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
        ];
    }
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['company_id', 'required', 'message' => 'Необходимо выбрать компанию'];
        return $rules;
    }
    /*
     * Метод возвращает массив, ключом которого является id предприятия,
     * а значением - оставшееся количество акция для этих предприятий
     */
    public function beforeCreate()
    {
        //Получение всех предприятий данного пользователя
        $company = Company::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['status' => 0])
            ->asArray()
            ->all();
        if(empty($company)) {
            return false;
        }
        //id ограничейний по акциям
        $service_id = [11, 12, 13];
        foreach ($company as $comp)
        {
            $company_id[] = $comp['id'];
        }
        //Получение компаний у которых подключена услуга акции
        $services = ServicesCompanyRelations::find()
            ->where(['in', 'company_id', $company_id] )
            ->with('services')
            //->joinWith('company')
            //->andWhere(['!=', '`company`.`tariff_id`', 0])
            ->andWhere(['in', 'services_id', $service_id])
            ->asArray()
            ->all();
        //Debug::prn($services);
        if($this->dateMonth())
        {
            $date = strtotime('first day of this month');
        }else $date = time() - 86400*31;
        foreach ($company_id as $id)
        {
            $promotion_count[$id] = Stock::find()
                ->where(['company_id' => $id])
                ->andWhere(['>', 'dt_add', $date])
                ->andWhere(['in', 'status', [0,1]])
                ->count();
        }
        //Debug::prn($promotion_count);
        $back_count = [];
        foreach ($services as $service)
        {
            /*Debug::prn($service['services']['val']);
            Debug::prn($promotion_count[$service['company_id']]);
            die();*/
            if($service['services']['val'] === '-')
            {
                $back_count[$service['company_id']] = '-';
            }else
            {
                $back_count[$service['company_id']] = $service['services']['val'] - $promotion_count[$service['company_id']];
                if($back_count[$service['company_id']] <= 0)
                {
                    unset($back_count[$service['company_id']]);
                }
            }
        }
        return $back_count;
    }
    //Метод проверяет прошёл ли месяц после добавления акции
    public function dateMonth()
    {
        $date = date_create(date('Y-m-d',Stock::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->min('dt_add')));
        $dateNow = date_create(date('Y-m-d', time()));
        $date_diff = date_diff($date, $dateNow);
        if($date_diff->m >= 1) return 1;
        else return 0;
    }
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
    public function getLikesCount()
    {
        return Likes::find()->where(['post_type' => 'stock', 'post_id' => $this->id])->count();
    }
}