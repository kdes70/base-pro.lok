<?php

namespace app\modules\user\models;

use app\modules\tender\models\Tender;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use app\modules\blog\models\Blog;
use app\modules\tender\models\TenderCustomer;
/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $username
 * @property string $auth_key
 * @property string $email_confirm_token
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $first_name
 * @property string $role
 * @property Blog[] $blogs
 * @property Profile $profile
 * @property TenderCustomer[] $tenderCustomers
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 2;

    const SCENARIO_PROFILE = 'profile';
    const SCENARIO_PERFORMER = 'performer';
    const SCENARIO_CUSTOMER = 'customer';

    const USER_CUSTOMER = 'customer';
    const USER_PERFORMER = 'performer';

    public $role;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_USERNAME_EXISTS')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => Yii::t('app', 'ERROR_EMAIL_EXISTS')],
            ['email', 'string', 'max' => 255],

            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusesArray())],

            ['first_name', 'string', 'max' => 32],

        ];
    }

    public function scenarios()
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_PROFILE => ['email', 'first_name'],
            //self::SCENARIO_CUSTOMER => ['email', '$password_hash']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => Yii::t('app', 'USER_CREATED'),
            'updated_at' => Yii::t('app', 'USER_UPDATED'),
            'username' => Yii::t('app', 'USER_USERNAME'),
            'email' => Yii::t('app', 'USER_EMAIL'),
            'status' => Yii::t('app', 'USER_STATUS'),
            'first_name' => Yii::t('app', 'USER_FIRST_NAME'),
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
            self::STATUS_BLOCKED => Yii::t('app', 'USER_STATUS_BLOCKED'),
            self::STATUS_ACTIVE => Yii::t('app', 'USER_STATUS_ACTIVE'),
            self::STATUS_WAIT => Yii::t('app', 'USER_STATUS_WAIT'),
        ];
    }

    //TODO ????
    public function getRoleUserName()
    {
        $roles = self::getRoleUserArray();
        return isset($roles[$this->role]) ? $roles[$this->role] : '';
    }

    public static function getRoleUserArray()
    {
        return [
            self:: USER_CUSTOMER => Yii::t('app', 'USER_CUSTOMER'),
            self:: USER_PERFORMER => Yii::t('app', 'USER_PERFORMER'),
        ];
    }

    /**
    * @inheritdoc
    */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('findIdentityByAccessToken is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTender()
    {
        return $this->hasMany(TenderCustomer::className(), ['customer_id' => 'id']);
    }

    public function getCustomerTenders()
    {
        return $this->hasMany(Tender::className(),['tender_id' => 'id'])
            ->viaTable(TenderCustomer::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTenderCustomers()
    {
        return $this->hasMany(TenderCustomer::className(), ['customer_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @param string $email_confirm_token
     * @return static|null
     */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_WAIT]);
    }

    /**
     * Generates email confirmation token
     */
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }

    /**
     * Removes email confirmation token
     */
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }
}
