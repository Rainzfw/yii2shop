<?php
namespace frontend\models;

use yii\base\Model;
use frontend\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * 登录
     *
     * @return User|null the saved model or null if saving fails
     */
    public function login()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = User::findOne(['username'=>$this->username]);
        if(!$user){
            $this->addError(['password'=>'用户不存在']);
            return null;
        }
        if(!\Yii::$app->security->validatePassword($this->password,$user->password_hash)){
            $this->addError(['password'=>'密码错误']);
            return null;
        }
        return $user;
    }
}
