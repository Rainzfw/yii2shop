<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 12:21
 */

namespace backend\models;


use yii\base\Model;

class ResetPwd extends Model
{
    public $old_password;
    public $new_password1;
    public $new_password2;
    public function rules(){
        return [
            [['old_password','new_password1','new_password2'],'required'],
            //验证确认密码要一致
            ['new_password2', 'compare','compareAttribute'=>'password'],
        ];
    }
}