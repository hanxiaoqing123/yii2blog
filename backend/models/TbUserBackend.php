<?php

namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbUserBackend".
 *
 * @property int $id 用户主键
 * @property string $userName 昵称
 * @property string $authKey 认证key
 * @property string $passwordHash 哈希密码
 * @property string $email 邮箱
 * @property string $createdAt 创建时间
 * @property string $updatedAt 更新时间
 */
class TbUserBackend extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbUserBackend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userName', 'authKey', 'passwordHash', 'email', 'createdAt', 'updatedAt'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['userName', 'passwordHash', 'email'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 32],
            [['userName'], 'unique'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userName' => 'User Name',
            'authKey' => 'Auth Key',
            'passwordHash' => 'Password Hash',
            'email' => 'Email',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /************************实现认证类的方法******************************/
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**************************自定义方法*******************************/
    public static function findByUsername($userName)
    {
        return static::findOne(['userName' => $userName]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }
}
