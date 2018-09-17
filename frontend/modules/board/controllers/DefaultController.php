<?php

namespace frontend\modules\board\controllers;

use common\classes\Debug;
use common\models\db\KeyValue;
use frontend\modules\board\models\Ads;
use frontend\modules\board\models\BoardFunction;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\Controller;

/**
 * Default controller for the `board` module
 */
class DefaultController extends Controller
{
    public $siteApi;
    public $apiKey;

    public function init()
    {
        $this->on('beforeAction', function ($event) {

            // запоминаем страницу неавторизованного пользователя, чтобы потом отредиректить его обратно с помощью  goBack()
            if (Yii::$app->getUser()->isGuest) {
                $request = Yii::$app->getRequest();
                // исключаем страницу авторизации или ajax-запросы
                if (!($request->getIsAjax() || strpos($request->getUrl(), 'login') !== false)) {
                    Yii::$app->getUser()->setReturnUrl($request->getUrl());
                }
            }
        });
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => [
                            'index', 'category-ads', 'view', 'get-children-category', 'show-city-list',
                            'search', 'general-modal', 'show-category', 'show-parent-modal-category',
                            'ShowCategoryEnd', 'show-additional-fields'
                        ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->siteApi = Yii::$app->params['site-api'];
        $this->apiKey = Yii::$app->params['api-key'];
        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $url = $this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page='
            . Yii::$app->request->get('page', 1) . '&api_key=' . $this->apiKey;
        if (!BoardFunction::isDomainAvailible($url)) {
            return $this->render('error');
        }

        $rez = BoardFunction::fileGetContent($url);
        //$rez = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page=' . Yii::$app->request->get('page',1));


        $rez = json_decode($rez);

        if (!isset($rez->_meta->totalCount)) {
            echo $rez;
        } else {
            $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $rez->_meta->totalCount,
                'pageSizeParam' => false,
            ]);
            return $this->render('index',
                [
                    'ads' => $rez->ads,
                    'pagination' => $pagination,
                    'meta_title' => KeyValue::findOne(['key' => 'board_title_page'])->value,
                    'meta_desc' => KeyValue::findOne(['key' => 'board_desc_page'])->value,
                ]
            );
        }
    }

    public function actionCategoryAds($slug)
    {
        $cat = BoardFunction::fileGetContent($this->siteApi . '/category/get-category-by-slug?cat='
            . Yii::$app->request->get('slug') . '&api_key=' . $this->apiKey);
        //$cat = file_get_contents($this->siteApi . '/category/get-category-by-slug?cat=' . Yii::$app->request->get('slug') . '&api_key=' . $this->apiKey);
        $cat = json_decode($cat);
        // Debug::prn($cat);


        $rez = BoardFunction::fileGetContent($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page='
            . Yii::$app->request->get('page', 1) . '&catId=' . $cat->id . '&api_key=' . $this->apiKey);
        /*$rez = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page=' . Yii::$app->request->get('page',
                1) . '&catId=' . $cat->id . '&api_key=' . $this->apiKey);*/

        $rez = json_decode($rez);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $rez->_meta->totalCount,
            'pageSizeParam' => false,
        ]);
        return $this->render('index',
            [
                'ads' => $rez->ads,
                'pagination' => $pagination,
                'meta_title' => $cat->name . ' |объявления на DA Info Pro',
                'meta_desc' => mb_substr("Свежие объявления о покупке и продаже бу и новых товаров в категории «" . $cat->name . "», " . $rez->_meta->totalCount . ". Бесплатно дать объявление вы можете разместив его на онлайн доске бесплатных объявлений ДНР и России сайта ДА Инфо Про.", 0, 100)

            ]
        );
    }

    public function actionView($slug, $id)
    {
        $url = $this->siteApi . '/ads/' . $id . '?expand=adsImgs,adsFieldsValues' . '&api_key=' . $this->apiKey;
        if (!BoardFunction::isDomainAvailible($url)) {
            return $this->render('error');
        }

        $ads = BoardFunction::fileGetContent($url);

        $ads = json_decode($ads);
        if (!isset($ads->title)) {
            echo $ads;
        } else {
            return $this->render('view',
                [
                    'ads' => $ads,
                ]
            );
        }

    }

    public function actionCreate()
    {
        $this->layout = 'personal_area';
        $url = $this->siteApi;
        if (!BoardFunction::isDomainAvailible($url)) {
            return $this->render('error');
        }


        if (Yii::$app->request->post()) {

            /* Debug::prn($_POST);
             Debug::dd($_FILES);
             die();*/
            //Debug::dd($_FILES);
            unset($_POST['_csrf']);
            $_POST['api_key'] = $this->apiKey;
            $_POST['Ads']['content'] = strip_tags($_POST['Ads']['content'], '\n');

            if (!empty($_FILES['file']['name'][0])) {
                if (!file_exists('media/users/' . Yii::$app->user->id)) {
                    mkdir('media/users/' . Yii::$app->user->id . '/');
                }
                if (!file_exists('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d'))) {
                    mkdir('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d'));
                }
                if (!file_exists('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb')) {
                    mkdir('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb');
                }

                $dir = 'media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
                $dirThumb = $dir . 'thumb/';
                $i = 0;

                foreach ($_FILES['file']['name'] as $file) {
                    Image::watermark($_FILES['file']['tmp_name'][$i],
                        $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/img/logo_watermark.png')
                        ->save($dir . $_FILES['file']['name'][$i], ['quality' => 100]);

                    Image::thumbnail($_FILES['file']['tmp_name'][$i], 142, 100,
                        $mode = \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND)
                        ->save($dirThumb . $file, ['quality' => 100]);


                    $_POST['img'][$i]['img_thumb'] = Url::home(true) . $dirThumb . $file;
                    $_POST['img'][$i]['img'] = Url::home(true) . $dir . $file;
                    $i++;
                }
            }
            if (!empty($_POST['Ads']['cover'])) {
                $_POST['Ads']['cover'] = Url::home(true) . 'media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb' . '/' . $_POST['Ads']['cover'];
            }


            //Debug::prn($_POST);

            $sURL = $this->siteApi . '/ads/create'; // URL-адрес POST


            $sPD = http_build_query($_POST); // Данные POST
            $aHTTP = [
                'http' => // Обертка, которая будет использоваться
                    [
                        'method' => 'POST', // Метод запроса
                        // Ниже задаются заголовки запроса
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $sPD,
                    ],
                'ssl' => array(
                    'verify_peer' => false,
                ),
            ];
            $context = stream_context_create($aHTTP);
            $contents = file_get_contents($sURL, false, $context);
            //echo $contents;
            Yii::$app->session->setFlash('success', 'Ваше объявление успешно добавлено. После прохождения модерации оно будет опубликовано.');
            return $this->redirect('/personal_area/user-ads/index');
        } else {
            $model = new Ads();

            $arrCity = BoardFunction::fileGetContent($this->siteApi . '/city/get-city-list');

            //Debug::prn(json_decode($arrCity, true));
            return $this->render('add-form-ads',
                [
                    'model' => $model,
                    'arraregCity' => json_decode($arrCity, true),
                ]);
        }

    }


    public function actionUpdate($id)
    {
        $this->layout = 'personal_area';
        if (Yii::$app->request->post()) {
            //Debug::dd($_POST);
            if (!empty($_FILES['file']['name'][0])) {

                if (!empty($_POST['Ads']['cover'])) {
                    $_POST['Ads']['cover'] = Url::home(true) . 'media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb' . '/' . $_POST['Ads']['cover'];
                } else {
                    $_POST['Ads']['cover'] = '';
                }
                if (!file_exists('media/users/' . Yii::$app->user->id)) {
                    mkdir('media/users/' . Yii::$app->user->id . '/');
                }
                if (!file_exists('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d'))) {
                    mkdir('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d'));
                }
                if (!file_exists('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb')) {
                    mkdir('media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/thumb');
                }

                $dir = 'media/users/' . Yii::$app->user->id . '/' . date('Y-m-d') . '/';
                $dirThumb = $dir . 'thumb/';
                $i = 0;

                foreach ($_FILES['file']['name'] as $file) {
                    Image::watermark($_FILES['file']['tmp_name'][$i],
                        $_SERVER['DOCUMENT_ROOT'] . '/frontend/web/img/logo_watermark.png')
                        ->save($dir . $_FILES['file']['name'][$i], ['quality' => 100]);

                    Image::thumbnail($_FILES['file']['tmp_name'][$i], 142, 100,
                        $mode = \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND)
                        ->save($dirThumb . $file, ['quality' => 100]);


                    $_POST['img'][$i]['img_thumb'] = Url::home(true) . $dirThumb . $file;
                    $_POST['img'][$i]['img'] = Url::home(true) . $dir . $file;
                    $i++;
                }
            }
            //Debug::prn($_POST);

            $sURL = $this->siteApi . '/ads/update'; // URL-адрес POST


            $sPD = http_build_query($_POST); // Данные POST
            $aHTTP = [
                'http' => // Обертка, которая будет использоваться
                    [
                        'method' => 'PATCH', // Метод запроса
                        // Ниже задаются заголовки запроса
                        'header' => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $sPD,
                    ],
                'ssl' => array(
                    'verify_peer' => false,
                ),
            ];
            $context = stream_context_create($aHTTP);
            $contents = file_get_contents($sURL, false, $context);
            //echo $contents;
            Yii::$app->session->setFlash('success', 'Ваше объявление успешно добавлено. После прохождения модерации оно будет опубликовано.');
            return $this->redirect('/personal_area/user-ads/index');
        } else {
            $model = new Ads();
            $ads = BoardFunction::fileGetContent($this->siteApi . '/ads/' . $id . '?expand=adsImgs,adsFieldsValues' . '&api_key=' . $this->apiKey);
            $ads = json_decode($ads);
            //Debug::dd($ads);
            $arrCity = BoardFunction::fileGetContent($this->siteApi . '/city/get-city-list');

            $categoryList = BoardFunction::fileGetContent($this->siteApi . '/category/get-list-category?id=' . $ads->category_id);
            $categoryList = json_decode($categoryList);
            $catList = $this->renderPartial('categoryList',
                [
                    'category' => array_reverse($categoryList),
                ]
            );

            $groupFieldsId = BoardFunction::fileGetContent($this->siteApi . '/category/ads-fields?id=' . $ads->category_id);
            $html = '';
            //Debug::prn($ads->adsFieldsValues);
            if (!empty($groupFieldsId)) {
                $fields = json_decode($groupFieldsId);
                foreach ($fields as $item) {
                    $html .= $this->renderPartial('add_fields_update', ['adsFields' => $item, 'adsFieldValue' => $ads->adsFieldsValues]);
                }

            }

            //Debug::prn(json_decode($arrCity, true));
            return $this->render('update-form-ads',
                [
                    'model' => $model,
                    'arraregCity' => json_decode($arrCity, true),
                    'ads' => $ads,
                    'categoryList' => $catList,
                    'html' => $html
                ]);
        }
    }

    public function actionDeleteImg()
    {
        $contents = file_get_contents($this->siteApi . '/ads/delimg?id=' . $_GET['id']);
        echo 1;
    }

    public function actionGetChildrenCategory()
    {
        if (!empty(Yii::$app->request->post('catId'))) {
            $catId = Yii::$app->request->post('catId');
            //Debug::prn($catId);
            $cat = file_get_contents($this->siteApi . '/category?parent=' . $catId);

            if ($cat != '[]') {
                return $this->renderPartial('children-category/category', ['cat' => json_decode($cat)]);
            } else {
                $fields = file_get_contents($this->siteApi . '/category/ads-fields?id=' . $catId);
                if (!empty($fields)) {
                    $fields = json_decode($fields);
                    $html = '';
                    foreach ($fields as $item) {
                        $html .= $this->renderPartial('children-category/filter_fields', ['adsFields' => $item]);
                    }
                    return $html;
                }

            }
        }
    }

    public function actionShowCityList()
    {
        $city = file_get_contents($this->siteApi . '/city?region=' . Yii::$app->request->post('id'));

        return $this->renderPartial('children-category/city-list', ['city' => json_decode($city)]);
    }

    public function actionSearch()
    {
        // Debug::prn(Yii::$app->request->get());
        $rez = BoardFunction::fileGetContent($this->siteApi . '/ads/search?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&' . http_build_query(Yii::$app->request->get()) . '&page=' . Yii::$app->request->get('page',
                1));
        /*$rez = file_get_contents($this->siteApi . '/ads/search?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&' . http_build_query(Yii::$app->request->get()) . '&page=' . Yii::$app->request->get('page',
                1));*/

        $rez = json_decode($rez);

        //Debug::prn($rez);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $rez->_meta->totalCount,
            'pageSizeParam' => false,
        ]);
        return $this->render('index',
            [
                'ads' => $rez->ads,
                'pagination' => $pagination,
                'meta_title' => 'Поиск ' . KeyValue::findOne(['key' => 'board_title_page'])->value,
                'meta_desc' => 'Поиск ' . KeyValue::findOne(['key' => 'board_desc_page'])->value,
            ]
        );

    }

    public function actionGeneralModal()
    {
        $category = BoardFunction::fileGetContent($this->siteApi . '/category?parent=0');
        echo $this->renderPartial('modal', ['category' => json_decode($category)]);
    }

    public function actionShowCategory()
    {
        $id = $_POST['id'];
        $parent_category = BoardFunction::fileGetContent($this->siteApi . '/category?parent=' . $id);

        if (!empty($parent_category)) {
            $category = BoardFunction::fileGetContent($this->siteApi . '/category?parent=0');
            $catName = BoardFunction::fileGetContent($this->siteApi . '/category/view?id=' . $id);
            $catName = json_decode($catName);
            echo $this->renderPartial('sel_cat',
                [
                    'category' => json_decode($category),
                    'parent_category' => json_decode($parent_category),
                    'title' => $catName->name,
                    'id' => $id,
                ]
            );
        } else {
            return false;
        }

    }

    public function actionShowParentModalCategory()
    {
        $id = $_POST['id'];
        $category = BoardFunction::fileGetContent($this->siteApi . '/category?parent=' . $id);
        $category = json_decode($category);
        $catName = BoardFunction::fileGetContent($this->siteApi . '/category/view?id=' . $id);
        $catName = json_decode($catName);

        if (!empty($category)) {
            return $this->renderPartial('shw_category',
                [
                    'category' => $category,
                    'title' => $catName->name,
                ]);
        }

        return false;

    }

    public function actionShowCategoryEnd()
    {
        $id = Yii::$app->request->post('id');
        $categoryList = BoardFunction::fileGetContent($this->siteApi . '/category/get-list-category?id=' . $id);
        $categoryList = json_decode($categoryList);
        echo $this->renderPartial('categoryList',
            [
                'category' => array_reverse($categoryList),
            ]
        );

    }

    public function actionShowAdditionalFields()
    {
        $id = Yii::$app->request->post('id');
        //$id = 4;
        $groupFieldsId = BoardFunction::fileGetContent($this->siteApi . '/category/ads-fields?id=' . $id);
//Debug::prn($groupFieldsId);
        $html = '';
        if (!empty($groupFieldsId)) {
            /*foreach ($adsFields as $adsField) {
                $adsFieldsAll = AdsFields::find()
                    ->leftJoin('ads_fields_type', '`ads_fields_type`.`id` = `ads_fields`.`type_id`')
                    ->leftJoin('ads_fields_default_value',
                        '`ads_fields_default_value`.`ads_field_id` = `ads_fields`.`id`')
                    ->where(['`ads_fields`.`id`' => $adsField->fields_id])
                    ->with('ads_fields_type', 'ads_fields_default_value')
                    ->all();
                $html .= $this->renderPartial('add_fields', ['adsFields' => $adsFieldsAll]);
            }*/

            $fields = json_decode($groupFieldsId);
            foreach ($fields as $item) {
                $html .= $this->renderPartial('add_fields', ['adsFields' => $item]);
            }

        }
        echo $html;

    }

    public function actionDelete($id)
    {

        $contents = BoardFunction::fileGetContent($this->siteApi . '/ads/edit?id=' . $id);
        echo $contents;
        //Yii::$app->session->setFlash('success','Ваше объявление успешно добавлено. После прохождения модерации оно будет опубликовано.');
        //return $this->redirect('/personal_area/user-ads');
    }

    public function actionPublicAds($id)
    {
        BoardFunction::fileGetContent($this->siteApi . '/ads/edit-status?id=' . $id . '&status=2' . '&api_key=' . $this->apiKey);

        Yii::$app->session->setFlash('success', 'Объявление обновлено');
        return $this->redirect(['/personal_area/user-ads/']);
    }
}
