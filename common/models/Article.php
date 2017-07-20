<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $sort
 * @property integer $status
 * @property integer $create
 */
class Article extends \yii\db\ActiveRecord
{
    public $content;
    protected static $statusArr=[1=>'正常', 2=>'隐藏', 3=>'删除'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','article_category_id'], 'required'],
            [['sort', 'status', 'create'], 'integer'],
            [['name'], 'string', 'max' => 20],
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
            'article_category_id' => '文章分类',
            'status' => '状态',
            'sort' => '排序',
            'create' => '时间',
            'content'=>'内容'
        ];
    }
    public function getArticleCategory(){
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
    public function getArticleDetail(){
        return $this->hasOne(ArticleDetail::className(),['article_id'=>'id']);
    }

    public function getStatustext(){
        if(array_key_exists($this->status,$this->statusArr)){
            return $this->statusArr[$this->status];
        }
        return '未知';
    }
    public static function getStatusarr($opt=true){
        if(!$opt){
            unset(self::$statusArr[3]);
        }
        return self::$statusArr;
    }

    public function beforeSave($insert){
        if($insert){
            $this->create = time();
        }
        return parent::beforeSave($insert);
    }
}
