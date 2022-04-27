<?php

namespace console\controllers;

use backend\modules\news\models\News;
use yii\console\Controller;

class ViewsForcingController extends Controller
{
    const NEWS_IDS = [30334, 30332, 30333];

    public $min, $max;

    function init()
    {
        parent::init();
    }

    public function options($actionID)
    {
        $options = parent::options($actionID);

        switch ($actionID) {
            case 'force-last-day-news':
                $options[] = 'min';
                $options[] = 'max';
                break;
            default:
                break;
        }

        return $options;
    }

    public function actionForceLastDayNews()
    {
        // За последние сутки
        $news = News::find()->where(['>', 'dt_public', time() - 86400])->all();

        foreach ($news as $rec) {
            $rec->views = $rec->views + rand($this->min, $this->max);
            $rec->save();
        }
    }
}