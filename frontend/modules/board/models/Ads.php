<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 23.08.2017
 * Time: 11:11
 */

namespace frontend\modules\board\models;

use yii\base\Model;

class Ads extends Model
{
    public $title;
    public $category_id;
    public $content;
    public $price;
    public $name;
    public $phone;
    public $mail;
    public $city_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'category_id', 'title', 'content',
                    'region_id', 'city_id', 'price',
                    'mail', 'name', 'phone'
                ],
                'required'
            ],
            [
                [
                    'category_id', 'region_id', 'city_id',
                    'price', 'dt_send_msg',
                    'business_id'
                ],
                'integer'
            ],
            [['content'], 'string', 'max' => 4096],
            [['title',  'mail'], 'string', 'max' => 255],
        ];


        /*return [
            $rules['title'] = ['title', 'string', 'max' => 70];
            $rules['content'] = ['title', 'string', 'max' => 4096];
            $rules['phone'] = ['phone', 'string', 'max' => 70];
            $rules['phone'] = [['phone'], 'required'];
            $rules['name'] = [['name'], 'required'];
            $rules['name'] = ['name', 'string', 'min' => 2, 'max' => 20];
            $rules['private_business'] = [['private_business'], 'required'];
        ];*/
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'category_id' => 'Категория',
            'content' => 'Описание',
            'price' => 'Цена',
            'city_id' => 'Местонахождение'
        ];
    }
}