<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $parent_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'parent_id','icon'], 'required'],
            [['created_at','parent_id','updated_at','lavel'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['description'], 'string', 'max' => 255],
            ['route', 'string'],
            [['name'], 'unique'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'description' => '描述',
            'parent_id' => '上级菜单',
            'route'=>'路由',
            'created_at'=>'创建时间',
            'updated_at'=>'修改时间',
            'icon'=>'图标'
        ];
    }
    //获取所有的菜单
    public static function getMenus($parent_id=0,$lavel=0){
        static $menusArr =[['id'=>0,'nametext'=>'顶级菜单']];
        $menus = self::find()->where(['parent_id'=>$parent_id])->asArray()->all();
        if($menus){
            foreach($menus as $menu){
                $menu['nametext'] = str_repeat('--',$lavel).$menu['name'];
                $menusArr[] = $menu;
                self::getMenus($menu['id'],$menu['lavel']+1);
            }
        }
        return $menusArr;
    }

    public function beforeSave($insert){
        if($insert){
            $this->created_at = time();
            $this->updated_at = time();
        }else{
            //判断是否修改到了子集下面
            $ids = self::find()->where(['parent_id'=>$this->id])->select('id')->column();
            if(in_array($this->parent_id,$ids)){
                $this->addError('parent_id','不能移动到子集下面');
                return false;
            }
            $this->updated_at = time();
        }
        $this->lavel = 0;
        //查询父级的水平是多少
        if($parentModel = self::findOne(['id'=>$this->parent_id])){
            $this->lavel = $parentModel->lavel + 1;
        }
        return  Parent::beforeSave($insert);
    }
    public function getParentName(){
        $model = self::findOne(['id'=>$this->parent_id]);
        if($model){
            return $model->name;
        }
        return '顶级菜单';
    }
    //获取所有菜单数据
    public static function getItems(){
        $itemsArr['items'][]=['label' => 'Menu Yii2', 'options' => ['class' => 'header']];
        $items = self::find()->select(['id','name','route','parent_id','lavel','icon'])->asArray()->all();
        if($items){
            foreach($items as $item){
                $tmp = ['label' => $item['name'], 'icon' => $item['icon'], 'url' => $item['route']? $item['route']:'#'];
                //顶级菜单
                switch($item['lavel']){
                    case 0:
                        $itemsArr['items'][$item['id']] = $tmp;
                        break;
                    case 1;
                        $itemsArr['items'][$item['parent_id']]['items'][$item['id']] = $tmp;
                        break;
                    case 2;
                        $parent = self::find()->select(['parent_id'])->where(['id'=>$item['parent_id']])->one();
                        $itemsArr['items'][$item[$parent->parent_id]]['items'][$item['parent_id']]['items'][$item['id']] = $tmp;
                        break;
                }
            }
        }
        return $itemsArr;
    }
}
