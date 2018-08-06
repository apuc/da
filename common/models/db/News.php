<?php

namespace common\models\db;

use common\models\Time;
use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $slug
 * @property string $tags
 * @property string $photo
 * @property integer $status
 * @property integer $user_id
 * @property integer $lang_id
 * @property integer $views
 * @property string $meta_title
 * @property string $meta_descr
 * @property integer $dt_public
 * @property integer $exclude_popular
 * @property integer $main_slider
 * @property string $author
 * @property integer $hot_new
 * @property integer $show_error
 * @property integer $region_id
 * @property integer $editor_choice
 * @property integer $company_id
 * @property integer $in_company
 * @property integer $show_prev_in_single
 * @property integer $dzen
 * @property string $alt
 *
 * @property CategoryNewsRelations[] $categoryNewsRelations
 * @property int $rss [int(1)]
 * @property Company $company
 */
class News extends \yii\db\ActiveRecord
{
    /*public $categoryId;*/
    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            $this->dzen = $this->dzen == 0 ? null : 1;
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'/*, 'categoryId'*/], 'required'],
            [['content'], 'string'],
            [
                ['dt_add', 'dt_update', 'status', 'user_id', 'lang_id', 'views', 'exclude_popular', 'rss', 'hot_new', 'show_error', 'region_id', 'editor_choice', 'company_id', 'dzen', 'show_prev_in_single', 'in_company'],
                'integer',
            ],
            [['title', 'slug', 'tags', 'photo', 'meta_title', 'meta_descr', 'alt'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 64],
            [['main_slider'], 'safe'],
            [
                ['company_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Company::className(),
                'targetAttribute' => ['company_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('news', 'ID'),
            'title' => Yii::t('news', 'Title'),
            'content' => Yii::t('news', 'Content'),
            'dt_add' => Yii::t('news', 'Dt Add'),
            'dt_update' => Yii::t('news', 'Dt Update'),
            'slug' => Yii::t('news', 'Slug'),
            'tags' => Yii::t('news', 'Tags'),
            'photo' => Yii::t('news', 'Photo'),
            'status' => Yii::t('news', 'Status'),
            'user_id' => Yii::t('news', 'User ID'),
            'lang_id' => Yii::t('news', 'Lang ID'),
            'views' => Yii::t('news', 'Views'),
            'meta_title' => Yii::t('news', 'Meta Title'),
            'meta_descr' => Yii::t('news', 'Meta Descr'),
            'dt_public' => Yii::t('news', 'Dt Public'),
            'exclude_popular' => Yii::t('news', 'Exclude popular'),
            'rss' => Yii::t('news', 'Rss'),
            'main_slider' => Yii::t('news', 'Main slider'),
            'author' => Yii::t('news', 'Author'),
            'hot_new' => Yii::t('news', 'Hot new'),
            'show_error' => Yii::t('news', 'Show_error'),
            'region_id' => Yii::t('news', 'RegionID'),
            'editor_choice' => Yii::t('news', 'Editor choice'),
            'company_id' => Yii::t('news', 'Company ID'),
            'alt' => Yii::t('news', 'Alt Tag'),
            'dzen' => Yii::t('news', 'Dzen'),
            'show_prev_in_single' => Yii::t('news', 'SPIN'),
            'in_company' => Yii::t('news', 'In company'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryNewsRelations()
    {
        return $this->hasMany(CategoryNewsRelations::className(), ['new_id' => 'id'])->with('cat');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasMany(CategoryNews::className(), ['id' => 'cat_id'])->via('categoryNewsRelations');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function mainSlider()
    {
        return self::find()
            ->where(['main_slider' => 1])
            ->andWhere(['<=', 'dt_public', time()])
            ->orderBy('dt_add DESC')
            ->with('category');
    }

    /**
     * @param $id
     * @return int|string
     */
    public static function getCommentsCount($id)
    {
        return Comments::find()->where(['post_type' => 'news', 'post_id' => $id, 'published' => 1])->count();
    }

    /**
     * @param $id
     * @return int|string
     */
    public static function getLikeCount($id)
    {
        return Likes::find()->where(['post_type' => 'news', 'post_id' => $id])->count();
    }

    /**
     * @param $id
     * @return array|TagsRelation[]|\yii\db\ActiveRecord[]
     */
    public static function getTags($id)
    {
        return TagsRelation::find()
            ->where(['post_id' => $id, 'type' => 'news'])
            ->with('tags')
            ->limit(2)
            ->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return array|Currency[]|CurrencyRate[]|KeyValue[]|News[]|TagsRelation[]|\yii\db\ActiveRecord[]
     */
    public static function getLastEconomicNews()
    {
        return News::find()
            ->select([
                '`news`.`title`',
                '`news`.`dt_public`',
                '`news`.`slug`',
                '`news`.`photo`',
            ])
            ->leftJoin('`category_news_relations` AS `cnr`', '`cnr`.`new_id` = `news`.`id`')
            ->where(['`cnr`.`cat_id`' => 6])
            ->andWhere(['>', '`news`.`dt_public`', time() - Time::MONTH])
            ->andWhere(['`news`.`status`' => 0])
            ->andWhere(['<=', '`news`.`dt_public`', time()])
            ->orderBy('`news`.`dt_public` DESC')
            ->limit(6)
            ->all();

    }
}
