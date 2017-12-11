<?php

namespace frontend\widgets;

use common\classes\Debug;
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
        $cookies = Yii::$app->request->cookies;
        $useReg = $cookies->getValue('regionId');

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


        /*$categoriesPosteEvents = ArrayHelper::getColumn(CategoryPoster::find()
            ->select('id')
            ->where(['!=', 'slug', 'kino'])
            ->all(),
            'id');

        $categoriesPostersRelationsEvents = ArrayHelper::getColumn(CategoryPosterRelations::find('poster_id')
            ->select('poster_id')
            ->where(['cat_id' => $categoriesPosteEvents])
            ->groupBy('poster_id')
            ->all(),
            'poster_id'
        );
        $events = \common\models\db\Poster::find()

            ->andWhere(['id' => $categoriesPostersRelationsEvents])
            ->orderBy('dt_event DESC')
            ->limit(4)
            ->with('categories')
            ->all();


        $categoriesPosterMovies = CategoryPoster::find()
            ->select('id')
            ->where(['=', 'slug', 'kino'])
            ->one()->id;

        $categoriesPostersRelationsMovies = ArrayHelper::getColumn(CategoryPosterRelations::find('poster_id')
            ->select('poster_id')
            ->where(['cat_id' => $categoriesPosterMovies])
            ->groupBy('poster_id')
            ->all(),
            'poster_id'
        );

        $movies = \common\models\db\Poster::find()
            ->andWhere(['id' => $categoriesPostersRelationsMovies])
            ->andWhere(['>=','dt_event_end', time()])
            ->orderBy('dt_event DESC')
            ->limit(4)
            ->with('categories')
            ->all();*/

        /*$premiere = json_decode(KeyValue::find()->where(['key' => 'main_posters'])->one()->value);

        $poster = \common\models\db\Poster::find()->where(['id' => $premiere->afisha_id])->one();*/




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