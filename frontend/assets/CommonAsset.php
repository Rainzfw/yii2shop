<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/4
 * Time: 10:02
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'style/base.css',
        'style/global.css',
        'style/header.css',
        'style/footer.css',
    ];
    public $js = [
        'js/jquery-1.8.3.min.js',
        'js/header.js',
    ];
    public $depends = [

        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
    //定义按需加载css文件，加载顺序在后面
    public static  function addCssFile($view,$cssFile){
        $view->registerCssFile($cssFile,[CommonAsset::className(),'depends'=>'frontend\assets\CommonAsset']);
    }
    //定义按需加载js文件，加载顺序在后面
    public static function addJsFile($view,$jsFile){
        $view->registerJsFile($jsFile,[CommonAsset::className(),'depends'=>'frontend\assets\CommonAsset']);
    }
}