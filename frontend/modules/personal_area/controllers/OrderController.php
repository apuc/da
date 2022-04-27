<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.03.18
 * Time: 10:45
 */

namespace frontend\modules\personal_area\controllers;

use common\classes\DaMail;
use common\classes\Debug;
use common\classes\Shop;
use common\models\db\Order;
use common\models\db\OrderProduct;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class OrderController extends Controller
{
    public $layout = 'personal_area';

    function init()
    {
        parent::init();
    }

    public function actionIndex($id)
    {
        $model = OrderProduct::find()->with(['order', 'products'])->where(['order_id' => $id])->all();
        $order = Order::getOrderById($id);
        return $this->render('index', ['model' => $model, 'order' => $order]);
    }

    public function actionAll()
    {
        return $this->render('all', ['model' => Order::getOrders()]);
    }

    public function actionChangeStatus($id, $status)
    {
        $model = Order::findOne(['id' => $id]);
        $model->status = $status;
        $model->save();

        DaMail::createMsg()->setSubject('Статус заказа')
            ->setTo($model->email)
            ->setFrom(['noreply@da-info.pro' => 'DA-Info'])
            ->setTpl('layouts/html')
            ->setContent('<div>Статус Вашего заказа: '.Order::$statusText[$status].'</div>')
            ->send();

        return $this->redirect(['all']);
    }
}