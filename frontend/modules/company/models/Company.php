<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.09.2016
 * Time: 13:03
 */

namespace frontend\modules\company\models;


use backend\modules\tags\models\TagsRelation;
use common\models\db\CategoryCompanyRelations;
use common\models\db\CompanyFeedback;
use common\models\db\CompanyPhoto;
use common\models\db\CompanyViews;
use common\models\db\Stock;
use common\models\db\News;
use frontend\modules\shop\models\Products;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class Company extends \common\models\db\Company
{
    public $categ;

    public static $submenuLabels = [
        'about' => 'О компании',
        'reviews' => 'Отзывы',
        'stocks' => 'Акции',
        'news' => 'Новости',
        'products' => 'Товары',
        'statistics' => 'Статистика',
        'map' => 'Карта',
    ];

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
            'region_id' => [
                'class' => 'common\behaviors\SaveRegionId',
                'in_attribute' => 'city_id',
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getcategory_company_relations()
    {
        return $this->hasMany(CategoryCompanyRelations::className(), ['company_id' => 'id']);
    }

    public function getTagss()
    {
        return $this->hasMany(TagsRelation::className(), ['post_id' => 'id']);
    }

    public function getPage($page)
    {
        $options = [];
        switch ($page) {
            case 'about':
                //Подсчёт количества просмотров
                Yii::$app->db->createCommand("INSERT INTO `company_views`(`user_id`, `company_id`, `date`, `ip_address`)
                                            VALUES (:user_id, :company_id, NOW(), :ip_address) 
                                              ON DUPLICATE KEY UPDATE `count`=`count` + 1",
                    [
                        ':user_id' => Yii::$app->user->getId() ? Yii::$app->user->getId() : 0,
                        ':company_id' => $this->id,
                        ':ip_address' => ip2long(CompanyViews::getIP())
                    ])
                    ->execute();
                $img = CompanyPhoto::findAll(['company_id' => $this->id]);
                $this->updateCounters(['views' => 1]);
                $options = [
                    'model' => $this,
                    'img' => $img,
                ];
                break;
            case 'reviews':
                $feedback = CompanyFeedback::find()->where(['company_id' => $this->id, 'status' => 1])->with('user')->all();
                $options = [
                    'model' => $this,
                    'feedback' => $feedback,
                ];
                break;
            case 'stocks':
                $stock = Stock::find()->where(['company_id' => $this->id])->all();
                $options = [
                    'stock' => $stock,
                ];
                break;
            case 'news':
                $news = News::find()->where(['company_id' => $this->id])->all();
                $options = [
                    'news' => $news,
                ];
                break;
            case 'products':
                $products = Products::find()
                    ->where(['company_id' => $this->id, 'status' => 1])
                    ->with('images')
                    ->orderBy('dt_update DESC')
                    ->all();
                $options = [
                    'products' => $products,
                ];
                break;
            case 'statistics':
                $allViews = $uniqueViews = 0;
                $countVision = (new Query())
                    ->select([
                        'company_id',
                        'date' => new Expression("DATE(`date`)"),
                        'all' => new Expression("SUM(`count`)"),
                        'unique' => new Expression("COUNT(*)"),
                    ])
                    ->from('company_views')
                    ->where(['company_id' => $this->id])
                    ->groupBy([
                        new Expression("DATE(`date`)"),
                        'company_id',
                    ])
                    ->all();
                foreach ($countVision as $item) {
                    $allViews += $item['all'];
                    $uniqueViews += $item['unique'];
                }
                $options = [
                    'allViews' => $allViews,
                    'uniqueViews' => $uniqueViews,
                ];
                if ($allViews) {
                    $optionsCV = [
                        'options' => [
                            'chart' => [
                                'type' => 'areaspline',
                            ],
                            'title' => ['text' => 'Количество посетителей'],
                            'xAxis' => [
                                'categories' => ArrayHelper::getColumn($countVision, function ($item) {
                                    return $item['date'];
                                }
                                )
                            ],
                            'yAxis' => [
                                'title' => ['text' => 'Количество']
                            ],
                            'series' => [
                                [
                                    'name' => 'Общие',
                                    'color' => 'grey',
                                    'data' => ArrayHelper::getColumn($countVision, function ($item) {
                                        return (int)$item['all'];
                                    }
                                    )
                                ],
                                [
                                    'name' => 'Уникальные',
                                    'color' => '#ff0200',
                                    'data' => ArrayHelper::getColumn($countVision, function ($item) {
                                        return (int)$item['unique'];
                                    }
                                    )
                                ]
                            ]
                        ]
                    ];
                    $countViewsRegion = (new Query())
                        ->select([
                            '`gc`.`name`',
                            '`sum`' => new Expression("SUM(`count`)"),
                            '`count`' => new Expression("COUNT(*)")
                        ])
                        ->from('`company_views`')
                        ->leftJoin('`geobase_ip_short` AS `gis`', '`ip_address` BETWEEN `gis`.`ip_begin` AND `gis`.`ip_end`')
                        ->leftJoin('`geobase_city` AS `gc`', '`gc`.`id` = `gis`.`city_id`')
                        ->where(['`company_id`' => $this->id])
                        ->groupBy([
                            '`gis`.`city_id`',
                        ])
                        ->orderBy('`sum` DESC')
                        ->all();
                    array_walk($countViewsRegion, function (&$item) {
                        $item['name'] = is_null($item['name']) ? $item['name'] = 'Не определено' : $item['name'];
                        $item['sum'] = (int)$item['sum'];
                        $item = array_values($item);
                    });
                    $optionsCVR = [
                        'options' => [
                            'chart' => [
                                'type' => 'pie',
                                'options3d' => [
                                    'enabled' => true,
                                    'alpha' => 45,
                                    'beta' => 0
                                ],
                            ],
                            'title' => [
                                'text' => 'Всего посетителей по городам'
                            ],
                            'series' => [[
                                'type' => 'pie',
                                'name' => 'Количество посетителей',
                                'data' => $countViewsRegion
                            ]]
                        ]
                    ];
                    $options['optionsCV'] = $optionsCV;
                    $options['optionsCVR'] = $optionsCVR;
                    $options['countViewsRegion'] = $countViewsRegion;
                }
                break;
            case 'map':
                $options = [];
                break;
        }
        return $options;
    }

    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        $label['categ'] = 'Категория';
        return $label;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules['categ'] = [['categ'], 'required'];
        return $rules;
    }
}