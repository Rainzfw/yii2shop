<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $sort
 * @property integer $status
 * @property integer $is_help
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    protected static $statusarr=[1=>'正常',2=>'隐藏',3=>'删除'];
    public static $ishelparr =[0=>'否',1=>'是'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort', 'status', 'is_help'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['intro'], 'string', 'max' => 300],
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
            'intro' => '描述',
            'sort' => '排序',
            'status' => '状态',
            'is_help' => '帮助类',
        ];
    }
    public static function getStatusarr($opt=true){
        if(!$opt){
            unset(self::$statusarr[3]);
        }
        return self::$statusarr;
    }
    public function getStatustext(){
        if(array_key_exists($this->status,self::$statusarr)){
            return self::$statusarr[$this->status];
        }
        return '未知';
    }
    public function getIshelptext(){
        if(array_key_exists($this->status,self::$ishelparr)){
            return self::$ishelparr[$this->is_help];
        }
        return '未知';
    }
}
