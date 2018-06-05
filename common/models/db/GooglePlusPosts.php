<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "google_plus_posts".
 *
 * @property int $id
 * @property string $updated
 * @property string $dt_publish
 * @property string $title
 * @property string $post_id
 * @property string $url
 * @property int $user_id
 * @property int $status
 * @property int $likes_count
 * @property int $reposts_count
 */
class GooglePlusPosts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'google_plus_posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['updated', 'post_id', 'url'], 'string', 'max' => 100],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'updated' => 'Дата обновления',
            'dt_publish' => 'Дата добавления',
            'title' => 'Текст',
            'post_id' => 'ID поста',
            'url' => 'Ссылка',
            'user_id' => 'ID пользователя',
        ];
    }

    public function getPhotos()
    {
        return $this->hasMany(GooglePlusPhoto::className(), ['post_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(GooglePlusUsers::className(), ['id' => 'user_id']);
    }

}
