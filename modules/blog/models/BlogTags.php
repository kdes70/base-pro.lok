<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "{{%blog_tags}}".
 *
 * @property integer $blog_id
 * @property integer $tags_id
 *
 * @property Blog $blog
 * @property Tags $tags
 */
class BlogTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%blog_tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_id', 'tags_id'], 'required'],
            [['blog_id', 'tags_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blog_id' => 'Blog ID',
            'tags_id' => 'Tags ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tags_id']);
    }
}
