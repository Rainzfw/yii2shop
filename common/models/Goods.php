<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $sn
 * @property string $name
 * @property string $logo
 * @property string $goods_cate_id
 * @property string $brand_id
 * @property string $shop_price
 * @property string $market_price
 * @property string $stock
 * @property integer $is_on_sale
 * @property integer $status
 * @property string $sort
 * @property string $create_time
 */
class Goods extends \yii\db\ActiveRecord
{
    protected static $statusarr=[1=>'正常',2=>'隐藏',3=>'删除'];
    protected static $isonsaleArr=[1=>'上架',2=>'下架'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sn', 'name', 'logo', 'goods_cate_id', 'brand_id', 'stock', 'sort'], 'required'],
            [['goods_cate_id', 'brand_id', 'stock', 'is_on_sale', 'status', 'sort', 'create_time'], 'integer'],
            [['shop_price', 'market_price'], 'number'],
            [['sn'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 20],
            [['logo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sn' => '货号',
            'name' => '名称',
            'logo' => '图片',
            'goods_cate_id' => '分类',
            'brand_id' => '品牌',
            'shop_price' => '本店价',
            'market_price' => '市场价',
            'stock' => '库存',
            'is_on_sale' => '上下架',
            'sort' => '排序',
            'status'=>'状态',
            'create_time'=>'创建时间'
        ];
    }
    public static function getStatusarr($opt = true){
        if($opt){
           unset(self::$statusarr[3]);
        }
        return self::$statusarr;
    }
    public  function getStatustext(){
        if(array_key_exists($this->status,self::$statusarr)){
            return self::$statusarr[$this->status];
        }
        return '未知';
    }
    public static  function getIsonsale(){
        return self::$isonsaleArr;
    }
    public function beforeSave($insert){
        if($insert){
            $this->create_time = time();
        }
        return parent::beforeSave($insert);
    }
    public function getIsonsaletext(){
        if(array_key_exists($this->is_on_sale,self::$isonsaleArr)){
            return self::$isonsaleArr[$this->is_on_sale];
        }
        return '未知';
    }
    public function getGoodscategory(){
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_cate_id']);
    }
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
    public function getGoodsintro(){
        return $this->hasOne(GoodsIntro::className(),['goods_id'=>'id']);
    }

}
