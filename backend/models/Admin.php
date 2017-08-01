<?php
namespace backend\models;
use common\models\User;

class Admin extends User
{
    const SCENARIO_ADD='add';
    const SCENARIO_EDIT='edit';

    public $password;
    public $codeCaptcha;
    public $roles;
    private static $statusarr=[
        self::STATUS_ACTIVE=>'正常',
        self::STATUS_DELETED=>'删除'
    ];
    public static function tableName()
    {
        return '{{%admin}}';
    }

    public function rules(){
        return [
            [['username','password','email','roles'], 'required'],
            [['created_at', 'updated_at','status'], 'integer'],
            [['email','username'], 'unique'],//不能直接在页面验证
            ['codeCaptcha', 'captcha'],//验证验证码
            ['auth_key', 'safe'],//验证验证码
        ];
    }
    public function attributeLabels(){
        return [
            'username'=>'用户名',
            'password'=>'密码',
            'email'=>'邮箱',
            'status'=>'状态',
            'created_at'=>'创建时间',
            'updated_at'=>'修改时间',
            'codeCaptcha'=>'验证码',
        ];
    }
    public function beforeSave($insert){
        if($insert){
            $this->setPassword($this->password);
            $this->generateAuthKey();
            $this->created_at = time();

        }else{
            if($this->password && !$this->validatePassword($this->password)){
                $this->setPassword($this->password);
            }
        }

        $this->updated_at = time();
        return parent::beforeSave($insert);
    }

    //获取用户状态
    public function getStatustext(){
        if(array_key_exists($this->status,self::$statusarr)){
            return self::$statusarr[$this->status];
        }
        return '未知';
    }
    public static  function getStatusarr(){
        return self::$statusarr;
    }


    public function afterSave($insert,$changedAttributes){

        $authManager = \Yii::$app->authManager;
        //添加用户角色
        if(!$insert){
            //删除用户已有的角色
            $authManager->revokeAll($this->id);
        }
        if(is_array($this->roles)){
            foreach($this->roles as $role){
                $role = $authManager->getRole($role);
                if($role){
                    $authManager->assign($role,$this->id);
                }
            }
        }
        return parent::afterSave($insert,$changedAttributes);
    }

}