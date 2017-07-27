<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/19
 * Time: 23:13
 */

namespace backend\controllers;
use common\models\GoodsGallery;
use flyok666\uploadifive\UploadAction;
use yii\web\Controller;
use flyok666\qiniu\Qiniu;
class UploadController extends Controller
{
    public function actions() {
        return [
            's-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@data',//修改了图片保存的路径
                'baseUrl' => "@dataweb",
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                //BEGIN METHOD
                //'format' => [$this, 'methodName'],
                //END METHOD
                //BEGIN CLOSURE BY-HASH
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = date('Ymd',time()).'/'.sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                //END CLOSURE BY-HASH
                //BEGIN CLOSURE BY TIME
//                'format' => function (UploadAction $action) {
//                    $fileext = $action->uploadfile->getExtension();
//                    $filehash = sha1(uniqid() . time());
//                    $p1 = substr($filehash, 0, 2);
//                    $p2 = substr($filehash, 2, 2);
//                    return "{$p1}/{$p2}/{$filehash}.{$fileext}";
//                },
                //END CLOSURE BY TIME
                'validateOptions' => [
                    'extensions' => ['jpg', 'png','gif','bmp'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    $action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                },
            ],
            'qiniu-upload'=>[
                'class' => UploadAction::className(),
                'basePath' => '@data',//修改了图片保存的路径
                'baseUrl' => "@dataweb",
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename =  date('Ymd',time()).'/'.sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                'validateOptions' => [
                    'extensions' => ['jpg', 'png','gif','bmp'],
                    'maxSize' => 1 * 1024 * 1024, //file size
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    //$action->getFilename(); // "image/yyyymmddtimerand.jpg"
                    //$action->getWebUrl(); //  "baseUrl + filename, /upload/image/yyyymmddtimerand.jpg"
                    $imgPath = $action->getSavePath(); // "/var/www/htdocs/upload/image/yyyymmddtimerand.jpg"
                    $qiniu = new Qiniu(\Yii::$app->params['qiniu']);
                    $key = $action->getFilename();//唯一标识key
                    $qiniu->uploadFile($imgPath,$key);//将图片从自己的服务器上传到七牛云
                    $action->output['fileUrl'] = $qiniu->getLink($action->getFilename());//获取七牛云图片地址
                },
            ],
            'u-upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
                'config' => [
                    "imageUrlPrefix"  => "http://img.yii2shop.cn",//图片访问路径前缀
                    "imagePathFormat" => "/uedit/{yyyy}{mm}{dd}/{time}{rand:6}",//上传保存路径
                    "imageRoot" => \Yii::getAlias("@data"),
                ],
            ],
            'g-upload' => [
                'class' => UploadAction::className(),
                'basePath' => '@data',//修改了图片保存的路径
                'baseUrl' => "@dataweb",
                'enableCsrf' => true, // default
                'postFieldName' => 'Filedata', // default
                'overwriteIfExist' => true,
                'format' => function (UploadAction $action) {
                    $fileext = $action->uploadfile->getExtension();
                    $filename = date('Ymd',time()).'/'.sha1_file($action->uploadfile->tempName);
                    return "{$filename}.{$fileext}";
                },
                'validateOptions' => [
                    'extensions' => ['jpg', 'png','gif','bmp'],
                    'maxSize' => 1 * 1024 * 1024,
                ],
                'beforeValidate' => function (UploadAction $action) {
                    //throw new Exception('test error');
                },
                'afterValidate' => function (UploadAction $action) {},
                'beforeSave' => function (UploadAction $action) {},
                'afterSave' => function (UploadAction $action) {
                    //将图片路径保存在相册表中
                    $gallery = new GoodsGallery();
                    $gallery->goods_id = \Yii::$app->request->get('goods_id');
                    $gallery->img_url=$action->getWebUrl();
                    $gallery->save();
                    $action->output['fileUrl'] = $action->getWebUrl();
                    $action->output['gallery_id'] = $gallery->id;

                },
            ],
        ];
    }
}