<?php

namespace app\modules\blog\models;

use Yii;
use dosamigos\taggable\Taggable;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\behaviors\TimestampBehavior;
use app\modules\user\models\User;

/**
 * This is the model class for table "{{%blog}}".
 *
 * @property integer $id
 * @property string $category_id
 * @property string $user_id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property string $prev_img
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 * @property User $user
 * @property BlogTags[] $blogTags
 */
class Blog extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISH = 1;
    const STATUS_DONT_PUBLISH = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog}}';
    }

    public function behaviors() {
        return [
            [
                'class' => Taggable::className(),
            ],

            TimestampBehavior::className(),

            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ],
            'slug' => [
                'class' => 'app\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['title', 'slug', 'text'], 'required'],
            ['text', 'string'],
            ['image', 'image', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],

            ['tagNames', 'match', 'pattern' => '/^[\w\s,]+$/', 'message' => 'В тегах можно использовать только буквы.'],
            [['category_id', 'tagNames', 'user_id', 'publication_at'], 'safe'],

           // ['tagNames', 'normalizeTags'],
            [['title', 'slug', 'prev_img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'user_id' => 'Автор',
            'tagNames' => 'Теги',
            'title' => 'Заголовок',
            'slug' => 'URL',
            'text' => 'Текст',
            'image' => 'Картинка',
            'status' => 'Статус',
            'publication_at' => 'Дата публикации',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
        ];
    }

    public function getStatusName()
    {
        $statuses = self::getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }

    public static function getStatusesArray()
    {
        return [

            self::STATUS_PUBLISH => Yii::t('app', 'BLOG_STATUS_PUBLISH'),
            self::STATUS_DONT_PUBLISH => Yii::t('app', 'BLOG_STATUS_DONT_PUBLISH'),
        ];
    }
    /**
     * Возвращает опубликованные посты
     * @return ActiveDataProvider
     */
    public static function getPublishedPosts()
    {
        return self::find()
                ->where(['status' => self::STATUS_PUBLISH])
                ->with('category')
                ->orderBy('id DESC');
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoryTitle()
    {
        $parent = $this->getCategory();

        return $parent ? $parent->title : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tags::className(), ['id' => 'tags_id'])->viaTable('kd_blog_tags', ['blog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTags()
    {
        return $this->hasMany(BlogTags::className(), ['blog_id' => 'id']);
    }






//    public function normalizeTags($attribute,$params)
//    {
//        $this->tags = Tags::array2string(array_unique(Tags::string2array($this->tags)));
//    }

}
