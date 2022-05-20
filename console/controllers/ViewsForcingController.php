<?php

namespace console\controllers;

use backend\modules\news\models\ForcedView;
use backend\modules\news\models\News;
use yii\console\Controller;

class ViewsForcingController extends Controller
{
    public $min, $max, $days;

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
            case 'force':
                $options[] = 'min';
                $options[] = 'max';
                $options[] = 'days';
                break;
            default:
                break;
        }

        return $options;
    }

    public function actionForceLastDayNews()
    {
        $min = $this->min ?? 1;
        $max = $this->max ?? 5;
        $this->forceNews(News::find()->select('id')->where(['>', 'dt_public', time() - 86400])->all(), $min, $max);
    }

    public function actionForce()
    {
        $days = $this->days ?? 1;
        $min = $this->min ?? 1;
        $max = $this->max ?? max($min+1, 5);
        $this->forceNews(News::find()->select('id')->where(['>', 'dt_public', time() - 86400 * $days])->all(), $min, $max);
    }

    public function forceNews($news, $min, $max)
    {
        $num = 0;
        foreach ($news as $rec) {
            $views = ForcedView::findOne(['news_id' => $rec->id]);
            if ($views) {
                $views->views = $views->views + rand($min, $max);
            } else {
                $views = new ForcedView();
                $views->news_id = $rec->id;
                $views->views += rand($min, $max);
            }
            $views->save();
            $num++;
        }
        echo $num > 0 ? "Views in $num News successfully updated!\n" : "Nothing to update!\n";
    }
}