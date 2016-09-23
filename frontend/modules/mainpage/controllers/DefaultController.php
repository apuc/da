<?php

namespace frontend\modules\mainpage\controllers;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\Lang;
use common\models\db\News;
use yii\web\Controller;

/**
 * Default controller for the `mainpage` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public $layout = 'portal';

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGet_news_by_cat(){
        $news = News::find()->leftJoin('category_news_relations', '`category_news_relations`.`new_id` = `news`.`id`');
        if($_POST['id'] == 0){
            $news->where(['lang_id'=>Lang::getCurrent()['id']]);
        }
        else {
            $news->where(['lang_id'=>Lang::getCurrent()['id'], 'cat_id' => $_POST['id']]);
        }
        $news = $news->limit(10)->all();
        return $this->renderPartial('news_list', ['news'=>$news]);
    }

    public function actionGet_news_by_id(){
        return $this->renderPartial('new_item', [
            'news' => News::findOne($_POST['id']),
        ]);
    }

    public function actionGet_company_by_cat(){
        $company = Company::find()
            ->leftJoin('category_company_relations', '`category_company_relations`.`company_id` = `company`.`id`')
            ->where(['lang_id'=>Lang::getCurrent()['id'], 'cat_id' => $_POST['id']])
            ->limit(5)
            ->all();
        return $this->renderPartial('company_list', [
            'company' => $company,
        ]);
    }
}
