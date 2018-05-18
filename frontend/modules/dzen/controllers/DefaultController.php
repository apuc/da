<?php

namespace frontend\modules\dzen\controllers;

use common\models\db\News;
use common\models\Item;
use common\models\Xml;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use yii\web\Controller;

/**
 * Default controller for the `dzen` module
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
        $model = News::find()->orderBy('id DESC')->limit(10)->all();
        //echo count($model);exit();
        $item = new Item('rss');
        $item->setAttribute('version', '2.0');
        $item->setAttribute('xmlns:content', 'http://purl.org/rss/1.0/modules/content/');
        $item->setAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
        $item->setAttribute('xmlns:media', 'http://search.yahoo.com/mrss/');
        $item->setAttribute('xmlns:atom', 'http://www.w3.org/2005/Atom');
        $item->setAttribute('xmlns:georss', 'http://www.georss.org/georss');

        $channel = new Item('channel');

        $title = new Item('title');
        $title->setContent('Новости Мира, Росии и ДНР сегодня');

        $link = new Item('link');
        $link->setContent('https://da-info.pro/');

        $description = new Item('description');
        $description->setContent('Портал России и ДНР DA Info Pro: новости, компании, афиши, консультации.');

        $language = new Item('language');
        $language->setContent('ru');

        $channel->addChildItem($title);
        $channel->addChildItem($link);
        $channel->addChildItem($description);
        $channel->addChildItem($language);

        foreach ((array)$model as $new) {
            //Создаем item
            $adItem = new Item('item');

            //Создаём заголовок
            $title = new Item('title');
            $title->setContent($new->title);
            $adItem->addChildItem($title);

            //Создаем ссылку
            $link = new Item('link');
            $link->setContent('https://da-info.pro/news/' . $new->slug);
            $adItem->addChildItem($link);

            //Создаём дату публикации
            $pubDate = new Item('pubDate');
            $pubDate->setContent(date('D, d M Y H:i:s O', $new->dt_add));
            $adItem->addChildItem($pubDate);

            //Создаём автора
            $author = new Item('author');
            $author->setContent($new->author);
            $adItem->addChildItem($author);

            //Создаём фото
            $enclosure = new Item('enclosure');
            $enclosure->setAttribute('url', 'https://da-info.pro' . $new->photo);
            $enclosure->setAttribute('type', 'image/jpeg');
            $adItem->addChildItem($enclosure);

            //Создаем контент
            $content = new Item('content:encoded');
            $content->setContent($this->renderPartial('new-dzen', ['item' => $new]));
            $adItem->addChildItem($content);

            $channel->addChildItem($adItem);

        }

        $item->addChildItem($channel);

        $xml = Xml::generate($item);
        //\Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        return $this->renderPartial('xml', ['xml' => $xml]);
    }

}
