<?php

namespace app\modules\dish\models;

use Yii;

/**
 * This is the model class for table "{{%dish_menu}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $alias
 * @property string $description
 * @property string $img
 * @property integer $status
 * @property integer $order
 *
 * @property DishMenuGroup[] $dishMenuGroups
 */
class DishMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dish_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'status', 'order'], 'integer'],
            [['name', 'alias', 'description', 'img'], 'required'],
            [['description'], 'string'],
            [['name', 'alias', 'img'], 'string', 'max' => 100],
            [['alias'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'name' => Yii::t('app', 'Name'),
            'alias' => Yii::t('app', 'Alias'),
            'description' => Yii::t('app', 'Description'),
            'img' => Yii::t('app', 'Img'),
            'status' => Yii::t('app', 'Status'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDishMenuGroups()
    {
        return $this->hasMany(DishMenuGroup::className(), ['id_menu' => 'id'])
            ->viaTable('dish_menu_group', ['id_dish' => 'id']);
    }
}
