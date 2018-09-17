<?php

namespace common\models\db;

use common\classes\Debug;
use common\classes\Shop;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $status
 * @property int $dt_add
 * @property int $shop_id
 */
class Order extends \yii\db\ActiveRecord
{
    public $cnt;
    public $sum;
    public $sum_sale;

    const ORDER_STATUS_WAITING = 0;
    const ORDER_STATUS_ACCEPTED = 1;
    const ORDER_STATUS_READY = 2;

    public static $statusText = [
        self::ORDER_STATUS_WAITING => 'Ожидает обработки',
        self::ORDER_STATUS_ACCEPTED => 'Принят',
        self::ORDER_STATUS_READY => 'Готов',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'phone', 'address'], 'required'],
            [['status', 'dt_add', 'shop_id', 'cnt', 'sum', 'sum_sale'], 'integer'],
            [['first_name', 'last_name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'status' => 'Status',
        ];
    }

    public function getProductCount()
    {
        return OrderProduct::find()->select(['SUM(`count`) AS count'])->where(['order_id' => $this->id])->one();
    }

    public static function getOrders()
    {
        $shopIds = Shop::getShopsByUserId(\Yii::$app->user->id);
        $model = self::find()
            ->select([
                '`o`.*',
                'SUM(  `op`.`count` ) cnt',
                'SUM(  `op`.`count` *  `p`.`price` ) sum',
                'SUM(  `op`.`count` * IF(  `p`.`new_price` >0,  `p`.`new_price` ,  `p`.`price` ) ) sum_sale',
            ])
            ->from('`order` o')
            ->leftJoin('`order_product` op', '`op`.`order_id` = `o`.`id`')
            ->leftJoin('`products` p', '`p`.`id` = `op`.`product_id`')
            ->where(['`o`.`shop_id`' => ArrayHelper::getColumn($shopIds, 'id')])
            ->groupBy('`o`.`id`')
            ->orderBy('`o`.`id` DESC')
            ->all();
        return $model;
    }

    public static function getOrderById($id)
    {
        $model = self::find()
            ->select([
                '`o`.*',
                'SUM(  `op`.`count` ) cnt',
                'SUM(  `op`.`count` *  `p`.`price` ) sum',
                'SUM(  `op`.`count` * IF(  `p`.`new_price` >0,  `p`.`new_price` ,  `p`.`price` ) ) sum_sale',
            ])
            ->from('`order` o')
            ->leftJoin('`order_product` op', '`op`.`order_id` = `o`.`id`')
            ->leftJoin('`products` p', '`p`.`id` = `op`.`product_id`')
            ->where(['`o`.`id`' => $id])
            ->one();
        return $model;
    }
}
