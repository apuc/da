<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\classes\UserFunction;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use common\models\db\MainPremiere;
use common\models\db\News;
use frontend\modules\mainpage\widgets\Poster;
use Yii;
use yii\base\Widget;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class MainPosters extends Widget
{

    public function run()
    {
        $useReg = UserFunction::getRegionUser();

        if ($useReg == -1) {
            $useReg = null;
        }

        $queryPosterAll = \common\models\db\Poster::find()


            ->andWhere(['>=','dt_event_end', time()]);

            //->limit(8)

            //$queryPosterAll->andWhere(['region_id' => NULL]);
            $queryPosterAll->andWhere(['region_id' => $useReg]);



        $posterAll = $queryPosterAll
            ->orderBy('dt_event DESC')
            ->with('categories')
            ->all();
        $kino = [];



        foreach ($posterAll as $key=>$value) {
           // Debug::prn($value['categories'][0]->slug);
            if($value['categories'][0]->slug == 'kino') {
                $post = ArrayHelper::remove($posterAll, $key);
                $kino[] = $post;
                if(count($kino) >= 4){break;}
            }
        }


        $mainPremiere = MainPremiere::find()
            ->where(['region_id' => $useReg])
            ->one();
        $premiereImages = null;
        $premiereDescription = null;
        $poster = null;
        if(!empty($mainPremiere)){
            $poster = \common\models\db\Poster::find()->where(['id' => $mainPremiere->afisha_id])->one();
            $premiereImages = explode(',',$mainPremiere->photo);
            $premiereDescription = $mainPremiere->description;
        }

        return $this->render('main_posters',
            [
                'events' => array_splice($posterAll, 0, 4),
                'movies' => $kino,
                'premiereImages' => $premiereImages,
                'premiereDescription' => $premiereDescription,
                'poster' => $poster,
            ]);
    }

}