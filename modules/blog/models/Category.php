<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $title
 * @property string $slug
 * @property string $prev_img
 * @property integer $order
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Blog[] $blogs
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'order', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'slug'], 'required'],
            [['title', 'slug'], 'string', 'max' => 100],
           // [['prev_img'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'parent_id' => 'Родитель',
            'title' => 'Название',
            'slug' => 'URL',
            'status' => 'Статус',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['category_id' => 'id']);
    }
}
