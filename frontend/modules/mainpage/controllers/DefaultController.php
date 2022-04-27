<?php

namespace frontend\modules\mainpage\controllers;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\CategoryCompany;
use common\models\db\Company;
use common\models\db\KeyValue;
use common\models\db\Lang;
use common\models\db\News;
use frontend\controllers\MainController;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `mainpage` module
 */
class DefaultController extends Controller
{
    function init()
    {
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */

    //public $layout = 'portal';

    public function actionIndex()
    {
        $keyVal = KeyValue::find()->all();
        $useReg = UserFunction::getRegionUser();
        return $this->render('index',
            [
                'meta' => ArrayHelper::index($keyVal, 'key'),
                'useReg' => $useReg,
            ]
        );
    }

    public function actionGet_news_by_cat()
    {
        $news = News::find()->leftJoin('category_news_relations', '`category_news_relations`.`new_id` = `news`.`id`');
        if ($_POST['id'] == 0) {
            $news->where(['lang_id' => Lang::getCurrent()['id']]);
        } else {
            $news->where(['lang_id' => Lang::getCurrent()['id'], 'cat_id' => $_POST['id']]);
        }
        $news = $news->limit(10)->all();

        return $this->renderPartial('news_list', ['news' => $news]);
    }

    public function actionGet_news_by_id()
    {
        return $this->renderPartial('new_item', [
            'news' => News::findOne($_POST['id']),
        ]);
    }

    public function actionGet_company_by_cat()
    {
        $all_cats = CategoryCompany::find()->where(['parent_id' => $_POST['id']])->all();
        $cats_id = [];
        foreach ($all_cats as $cat) {
            $cats_id[] = $cat->id;
        }
        //Debug::prn($cats_id);

        $company = Company::find()
            ->leftJoin('category_company_relations', '`category_company_relations`.`company_id` = `company`.`id`')
            ->where(['lang_id' => Lang::getCurrent()['id'], 'cat_id' => $cats_id])
            ->limit(10)
            ->all();

        //Debug::prn($company->createCommand()->getRawSql());
        return $this->renderPartial('company_list', [
            'company' => $company,
        ]);
    }
}
