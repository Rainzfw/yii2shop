<?php

namespace common\models;

use Yii;
use yii\web\HttpException;
use yii\web\UploadedFile;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    public $imgFile;
    protected static $statusArr=[1=>'正常', 2=>'隐藏', 3=>'删除'];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['imgFile','file'],
            [['name'], 'required'],
            [['intro'], 'string'],
            [['sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['logo'], 'string', 'max' => 200],
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
            'logo' => '图片',
            'sort' => '排序',
            'status' => '状态',
            'imgFile'=>'品牌logo'
        ];
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
    //添加文件图片
    public function add(){
       $this->imgFile = UploadedFile::getInstance($this,'imgFile');
       $this->logo='';
       if($this->imgFile){
           //创建文件目录
           $filePath = Yii::getAlias('@data').'/'.date('Y-m-d',time());
           if(!is_dir($filePath)){
               if(!mkdir($filePath,'0777',true)){
                   throw new HttpException('创建目录失败');
               }
           }
           //创建文件名
           $filename =$filePath.'/'.uniqid(time()).'.'.$this->imgFile->getExtension();
           if(!$this->imgFile->saveAs($filename)){
               throw new HttpException('保存图片失败');
           }
           $this->logo=str_replace(Yii::getAlias('@data'),'',$filename);

       }
        return $this->save();
    }

}
