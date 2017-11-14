<?php

namespace frontend\modules\coin\controllers;

use common\classes\Debug;
use common\models\db\Coin;
use frontend\modules\coin\models\CoinRates;
use yii\web\Controller;

/**
 * Default controller for the `coin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $date = date('Y-m-d', time());
        $coinRates = CoinRates::find()
            ->joinWith('coin')
            ->where(['coin.status' => Coin::STATUS_ACTIVE])
            ->andWhere(['date' => $date])
            ->all();
        $bitcoin = 0;
        $ethereum = 0;
        foreach ($coinRates as $item) {
            if ($item->coin_name == 'BTC') {
                $bitcoin = $item->usd;
            }
            if ($item->coin_name == 'ETH') {
                $ethereum = $item->usd;
            }
        }
        return $this->render('index', [
            'coinRates' => $coinRates,
            'bitcoin' => $bitcoin,
            'ethereum' => $ethereum,
        ]);
    }
}
