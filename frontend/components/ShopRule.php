<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01.02.18
 * Time: 13:36
 */

namespace frontend\components;

use common\classes\Debug;
use frontend\modules\shop\models\CategoryShop;
use yii\web\UrlRuleInterface;

class ShopRule implements UrlRuleInterface {

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'shop/shop/category') {
            $url = '';
            foreach ($params['category'] as $item) {
                $url .= $item . '/';
            }
            $url = substr($url, 0, -1);
            if (isset($params['category'])) {
                return '/shop/' . $url ;
            }
        }

        if($route === 'shop/shop/product') {
            if (isset($params['slug'])) {
                return '/shop/product/' . $params['slug'];
            }
        }
        return false;  // данное правило не применимо
    }

    public function parseRequest($manager, $request)
    {
        /*$pathInfo = $request->getPathInfo();

        Debug::prn($pathInfo);

        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches)) {
            // Ищем совпадения $matches[1] и $matches[3]
            // с данными manufacturer и model в базе данных
            // Если нашли, устанавливаем $params['manufacturer'] и/или $params['model']
            // и возвращаем ['car/index', $params]
            //Debug::prn($manager);
        }*/
        return false;  // данное правило не применимо
    }


}