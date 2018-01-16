<?php

namespace common\models\db;

use common\classes\Debug;
use dektrium\user\models\User;
use himiklab\ipgeobase\IpGeoBase;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "company_views".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $company_id
 * @property string $date
 * @property integer $ip_address
 * @property integer $count
 *
 * @property Company $company
 * @property User $user
 */
class CompanyViews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_views';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'company_id', 'ip_address', 'count'], 'integer'],
            [['date'], 'safe'],
            [['user_id', 'company_id', 'ip_address'], 'unique', 'targetAttribute' => ['user_id', 'company_id', 'ip_address'], 'message' => 'The combination of User ID, Company ID and Ip Address has already been taken.'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('company_views', 'ID'),
            'user_id' => Yii::t('company_views', 'User ID'),
            'company_id' => Yii::t('company_views', 'Company ID'),
            'date' => Yii::t('company_views', 'Date'),
            'ip_address' => Yii::t('company_views', 'Ip Address'),
            'count' => Yii::t('company_views', 'Count'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return mixed
     */
    public static function getIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
