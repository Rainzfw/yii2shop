<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 8:56
 */

namespace backend\models;


use yii\base\Model;
use yii\helpers\ArrayHelper;

class Role extends Model
{
    public $name;
    public $description;
    public $permissions;
    public function attributeLabels(){
        return [
            'name'=>'名称',
            'description'=>'描述',
            'permissions'=>'权限',
        ];
    }
    public function rules(){
        return [
            [['name','description','permissions'],'required'],
            [['name','description'],'string']
        ];
    }
    //加载old_permission数据
    public function loadRole(\yii\rbac\Role $role){
        $this->name = $role->name;
        $this->description = $role->description;
        $this->permissions = ArrayHelper::map(\Yii::$app->authManager->getPermissionsByRole($role->name),'name','name');
    }


}