<?php

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\CategoryPoster;
use common\models\db\CategoryPosterRelations;
use common\models\db\KeyValue;
use common\models\db\News;
use frontend\modules\mainpage\widgets\Poster;
use yii\base\Widget;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class MainPosters extends Widget
{

    public function run()
    {

        $categoriesPosteEvents = ArrayHelper::getColumn(CategoryPoster::find()
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
            /*->Where(['>=', 'dt_event', strtotime('now 00:00:00')])*/
            ->andwhere(['id' => $categoriesPostersRelationsEvents])
            ->orderBy('dt_event')
            ->limit(4)
            ->with('categories')
            ->all();

        //movies
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
           /* ->Where(['>=', 'dt_event', strtotime('now 00:00:00')])*/
            ->andwhere(['id' => $categoriesPostersRelationsMovies])
            ->orderBy('dt_event')
            ->limit(4)
            ->with('categories')
            ->all();

        $premiere = json_decode(KeyValue::find()->where(['key' => 'main_posters'])->one()->value);

        return $this->render('main_posters',
            [
                'events' => $events,
                'movies' => $movies,
                'premiereImages' => explode(',',$premiere->main_posters),
                'premiereDescription' => $premiere->description,
            ]);
    }

}