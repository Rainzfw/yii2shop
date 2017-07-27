<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    //添加js
    public static function addJs($view,$jsFile){
        $view->registerJsFile($jsFile,[
            AppAsset::className(),
            'depends'=>AppAsset::className()
        ]);
    }
    //添加css
    public static function addCss($view,$cssFile){
        $view->registerCssFile($cssFile,[
            AppAsset::className(),
            'depends'=>AppAsset::className()
        ]);
    }
}
