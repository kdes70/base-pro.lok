<?php

namespace app\modules\dish\models;

use Yii;

/**
 * This is the model class for table "{{%dishs}}".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $name
 * @property string $alias
 * @property string $description
 * @property integer $weight
 * @property string $value
 * @property string $price
 * @property string $img
 * @property integer $status
 * @property integer $order
 *
 * @property DishMenuGroup[] $dishMenuGroups
 */
class Dishs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dishs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'weight', 'status', 'order'], 'integer'],
            [['name', 'alias', 'description', 'weight', 'img'], 'required'],
            [['description', 'value'], 'string'],
            [['price'], 'number'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['img'], 'string', 'max' => 100],
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
            'menu_id' => Yii::t('app', 'Menu ID'),
            'name' => Yii::t('app', 'Name'),
            'alias' => Yii::t('app', 'Alias'),
            'description' => Yii::t('app', 'Description'),
            'weight' => Yii::t('app', 'Weight'),
            'value' => Yii::t('app', 'Value'),
            'price' => Yii::t('app', 'Price'),
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
        return $this->hasMany(DishMenuGroup::className(), ['id_dish' => 'id'])
            ->viaTable('dish_menu_group', ['id_menu' => 'id']);
    }
}
