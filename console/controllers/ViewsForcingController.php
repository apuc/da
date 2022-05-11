<?php

namespace console\controllers;

use backend\modules\news\models\ForcedView;
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
        $news = News::find()->select('id')->where(['>', 'dt_public', time() - 86400])->all();
        $num = 0;
        foreach ($news as $rec) {
            $views = ForcedView::findOne(['news_id' => $rec->id]);
            if ($views) {
                $views->views = $views->views + rand($this->min, $this->max);
            } else {
                $views = new ForcedView();
                $views->news_id = $rec->id;
                $views->views += rand($this->min, $this->max);
            }
            $views->save();
            $num++;
        }

        echo $num > 0 ? "Views in $num News successfully updated!\n" : "Nothing to update!\n";
    }
}