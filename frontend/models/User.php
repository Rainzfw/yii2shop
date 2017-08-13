<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/13
 * Time: 10:13
 */

namespace frontend\models;


class User extends \common\models\User
{
    public function rules(){
        return [
            [['username','password_hash','email','tel','auth_key'], 'required'],
            [['created_at', 'updated_at','status'], 'integer'],
            [['email','username','tel'], 'unique'],
        ];
    }

}