<?php


namespace backend\models;


class SignupForm extends \yii\base\Model
{
    public $userName;
    public $email;
    public $password;
    public $createdAt;
    public $updatedAt;

    /**
     * @inheritdoc
     * 对数据的校验规则
     */
    public function rules()
    {
        return [
            ['userName', 'filter', 'filter' => 'trim'],
            ['userName', 'required', 'message' => '用户名不可以为空'],
            ['userName', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '用户名已存在.'],
            ['userName', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不可以为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => 'email已经被设置了.'],
            ['password', 'required', 'message' => '密码不可以为空'],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],
            [['createdAt', 'updatedAt'], 'default', 'value' => date('Y-m-d H:i:s')],
        ];
    }

    /**
     * Signs user up.
     *
     * @return true|false 添加成功或者添加失败
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new UserBackend();
        $user->userName = $this->userName;
        $user->email = $this->email;
        $user->createdAt = $this->createdAt;
        $user->updatedAt = $this->updatedAt;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save(false);
    }

}