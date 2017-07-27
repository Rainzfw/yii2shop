<?php

namespace common\models;

use backend\models\GoodsCategoryQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Yii;
use yii\helpers\Json;
use yii\web\HttpException;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property string $parent
 * @property string $name
 * @property string $intro
 * @property string $tree
 * @property string $lft
 * @property string $rgt
 * @property string $depth
 * @property string $content
 * @property integer $create_time
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'tree', 'lft', 'rgt', 'depth', 'create_time'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['intro'], 'string', 'max' => 200],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => '上级分类',
            'name' => '名称',
            'intro' => '简介',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'create_time' => '创建时间',
        ];
    }
    //实现nested-sets类
    public function behaviors(){
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                 'leftAttribute' => 'lft',
                 'rightAttribute' => 'rgt',
                 'depthAttribute' => 'depth',
            ],
        ];
    }
    //开启事务
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
    //设置静态方法获取所有的节点
    public static function find()
    {
        return new GoodsCategoryQuery(get_called_class());
    }
    //添加商品分类的添加
    public function add(){
        $this->create_time=time();
        //是否添加顶级分类
        if(!$this->parent_id){
            $this->parent_id = 0;
            return $this->makeRoot();
        }else{
            //找到父级节点
            $parentRoot = GoodsCategory::findOne($this->parent_id);
            if(!$parentRoot){
                throw new HttpException('上级分类不存在!');
            }
            return $this->appendTo($parentRoot);
        }
    }
    //添加商品分类的添加
    public function edit(){
        //获取到旧的属性
        if($this->getOldAttribute('parent_id')){
            return $this->save();
        }
        //获取当前节点的所有的子节点 其实插件已经帮我做了判断
        $ids = array_merge([$this->id],self::find()->select(['id'])->where(['parent_id'=>$this->id])->column());
        if(in_array($this->parent_id,$ids)){
            throw new HttpException('不能修改到本身及子节点下面');
        }
        //是否添加顶级分类
        if(!$this->parent_id){
            return $this->makeRoot();
        }else{
            //找到父级节点
            $parentRoot = GoodsCategory::findOne($this->parent_id);
            if(!$parentRoot){
                throw new HttpException('上级分类不存在!');
            }
            return $this->appendTo($parentRoot);
        }
    }
    //获取所有的分类 获取删除了的
    public static function getAlljson(){
        $zNodes=self::find()->select(['id','parent_id','name'])->asArray()->all();
        $zNodes  = array_merge([['parent_id'=>0,'id'=>0,'name'=>'顶级分类']],$zNodes);
        return json_encode($zNodes);
    }
    //获取父级节点的名字
    public function getParent(){
        return $this->hasOne(GoodsCategory::className(),['id'=>'parent_id']);
    }

}
