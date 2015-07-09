<?php

namespace app\modules\blog\models;

use Yii;

/**
 * This is the model class for table "{{%tags}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $frequency
 *
 * @property BlogTags[] $blogTags
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogTags()
    {
        return $this->hasMany(BlogTags::className(), ['tags_id' => 'id']);
    }

    /**
     * HERE IS YOUR method
     * @param string $name
     * @return Tags[]
     */
    public static function findAllByName($name)
    {
        return Tags::find()
            ->where(['like', 'name', $name])->limit(50)->all();
    }

//    public static function string2array($tags)
//    {
//        return preg_split('/\s*,\s*/', trim($tags), -1, PREG_SPLIT_NO_EMPTY);
//    }

    public static function array2string($tags)
    {
        return implode(', ',$tags);
    }
}
