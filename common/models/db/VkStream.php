<?php

namespace common\models\db;

use common\classes\Debug;
use common\models\VK;
use Yii;
use \backend\modules\vk\models\VkComments;
use frontend\models\user\Profile;
use common\models\User;

/**
 * This is the model class for table "vk_stream".
 *
 * @property integer $id
 * @property string $vk_id
 * @property integer $from_id
 * @property integer $owner_id
 * @property integer $owner_type
 * @property integer $dt_add
 * @property string $post_type
 * @property string $text
 * @property integer $from_type
 * @property integer $status
 * @property integer $views
 * @property integer $likes
 * @property integer $dt_publish
 * @property integer $user_id
 */
class VkStream extends \yii\db\ActiveRecord
{
    public $all_comments;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_stream';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vk_id'], 'required'],
            [['from_id', 'owner_id', 'owner_type', 'dt_add', 'from_type', 'status', 'views', 'likes', 'comment_status', 'rss', 'user_id'], 'integer'],
            [['text', 'slug', 'title', 'meta_descr'], 'string'],
            [['vk_id', 'post_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vk_id' => 'ВК',
            'from_id' => 'From ID',
            'owner_id' => 'Owner ID',
            'owner_type' => 'Owner Type',
            'dt_add' => 'Дата',
            'post_type' => 'Post Type',
            'text' => 'Текст',
            'from_type' => 'From Type',
            'status' => 'Статус',
            'views' => 'Просмотры',
            'likes' => 'Лайки',
            'title' => 'Заголовок',
            'slug' => 'Slug',
            'meta_descr' => 'Мета описание',
            'comment_status' => 'Публиковать комментарии'
        ];
    }

    public function getPhoto()
    {
        return $this->hasMany(VkPhoto::className(), ['post_id' => 'id'])->where(['comment_id' => 0]);
    }

    public function getGif()
    {
        return $this->hasMany(VkGif::className(), ['post_id' => 'id'])->where(['comment_id' => 0]);
    }

    public function getComments()
    {
        return $this->hasMany(VkComments::className(), ['post_id' => 'id'])->with('author');
    }

    public function getAuthor()
    {
        return $this->hasOne(VkAuthors::className(), ['vk_id' => 'from_id']);
    }

    public function getGroup()
    {
        return $this->hasOne(VkGroups::className(), ['vk_id' => 'from_id']);
    }

    public function getLikesCount()
    {
        return Likes::find()->where(['post_type' => 'stream', 'post_id' => $this->id])->count();
    }

    public static function getPosts($limit = 10, $offset = 0, $dt_publish = null)
    {
       if(!$dt_publish) $dt_publish = time();

        return self::find()
            ->where(['status' => 1])
            ->andWhere(['<', 'dt_publish', $dt_publish])
            ->orderBy('`vk_stream`.`dt_publish` DESC')
            ->limit($limit)
            ->offset($offset)
            ->with('gif', 'photo', 'author', 'group')
            ->all();

    }

    public static function getPostsTop($limit = 5)
    {

        return self::find()
            ->where(['status' => 1])
            ->andWhere(['>', 'views', 10])
            ->andWhere(['<', 'dt_publish', time()])
            ->orderBy('`vk_stream`.`dt_publish` DESC')
            ->limit($limit)
            ->with('gif', 'photo', 'author', 'group')
            ->orderBy('RAND()')
            ->all();

    }

    public function getLargePhoto()
    {
        $photo = VkPhoto::findOne(['post_id' => $this->id]);

        if(empty($photo)) {
            return '/theme/portal-donbassa/img/no-image.png';
        }

        if($photo->photo_1280)
            return $photo->photo_1280;

        if($photo->photo_807)
            return $photo->photo_807;

        if($photo->photo_604)
            return $photo->photo_604;

        if($photo->photo_512)
            return $photo->photo_512;

        if($photo->photo_130)
            return $photo->photo_130;
        return '/theme/portal-donbassa/img/no-image.png';
    }

    public static function getPublishedCount()
    {
        return self::find()
            ->where(['status' => 1])
            ->andWhere(['<','dt_publish', time()])
            ->count();
    }

    public function getAllComments()
    {
        $vk_comments = VkComments::find()->with('author', 'photo')->where(['post_id' => $this->id])->all();
        $comments = Comments::find()->where(['post_id' => $this->id])
            ->andWhere(['post_type' => 'vk_post'])
            ->andWhere(['published' => 1])
            ->all();

        if($this->comment_status != 0)
        {
            if(!empty($comments) && !empty($vk_comments))
            {
                $this->all_comments = $this->setAllComments($vk_comments, $comments);
            }elseif (!empty($vk_comments))
            {
                $this->all_comments =  $this->setAllComments($vk_comments);
            }else $this->all_comments =  $this->setAllComments(null, $comments);
        }
    }

    public function setAllComments($vk_comments, $comments = null)
    {
        $comment_result = [];
        if ($vk_comments) {
            foreach ($vk_comments as $comment) {
                if((stristr($comment->text, '[id'))){
                    $start = strpos($comment->text,'|')+ 1;
                    $string = substr($comment->text, $start, strpos($comment->text,']') - $start);
                    $comment->text = $string.
                        substr($comment->text, strpos($comment->text,']') + 1 );
                }

                $comment_result[] = [
                    'username' => $comment->author['first_name'] . ' ' . $comment->author['last_name'],
                    'avatar' => $comment->author['photo'],
                    'text' => $comment->text,
                    'photo' => (!empty($comment->photo)) ? $comment->photo[0]->getLargePhoto() : '',
                    'sticker' => (!empty($comment->sticker)) ? $comment->sticker: '',
                ];
            }
        }

        if ($comments) {
            foreach ($comments as $comment) {
                $photo = Profile::find()->select('avatar')->where(['user_id' => $comment->user_id])
                    ->asArray()
                    ->one();

                $username = User::find()->select('username')->where(['id' => $comment->user_id])
                    ->asArray()
                    ->one();

                $comment_result[] =
                    [
                        'username' => $username['username'],
                        'avatar' => $photo['avatar'],
                        'text' => $comment->content
                    ];
            }
        }
        //Debug::prn($comment_result);
        return $comment_result;
    }
}
