<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/28
 * Time: 9:23
 */

namespace backend\models;


use yii\base\Model;
use yii\rbac\Permission;

class Permisssion extends Model
{
    public $name;
    public $description;
    public function attributeLabels(){
        return [
            'name'=>'名称',
            'description'=>'描述',
        ];
    }
    public function rules(){
        return [
            [['name','description'],'required'],
            [['name','description'],'string']
        ];
    }
    //加载old_permission数据
    public function loadPermission(Permission $permission){
        $this->name = $permission->name;
        $this->description = $permission->description;
    }

}