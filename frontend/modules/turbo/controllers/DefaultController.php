<?php

namespace frontend\modules\turbo\controllers;

use common\models\db\News;
use common\models\Item;
use common\models\Xml;
use yii\web\Controller;

/**
 * Default controller for the `turbo` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionNews()
    {
        $model = News::find()->orderBy('id DESC')->all();

        $item = new Item('rss');
        $item->setAttribute('xmlns:yandex', 'http://news.yandex.ru');
        $item->setAttribute('xmlns:media', 'http://search.yahoo.com/mrss/');
        $item->setAttribute('xmlns:turbo', 'http://turbo.yandex.ru');

        $channel = new Item('channel');

        foreach ((array)$model as $new) {
            //Создаем item
            $adItem = new Item('item');
            $adItem->setAttribute('turbo', 'true');

            //Создаем ссылку
            $link = new Item('link');
            $link->setContent('https://da-info.pro/news/' . $new->slug);
            $adItem->addChildItem($link);

            //Создаем контент
            $content = new Item('turbo:content');
            $content->setContent($this->renderPartial('new-turbo', ['item' => $new]));
            $adItem->addChildItem($content);

            $channel->addChildItem($adItem);
        }

        $item->addChildItem($channel);

        $xml = Xml::generate($item);
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        return $this->renderPartial('xml', ['xml' => $xml]);
    }
}
