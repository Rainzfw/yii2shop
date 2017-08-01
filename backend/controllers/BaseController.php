<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/29
 * Time: 9:02
 */

namespace backend\controllers;


use backend\filters\BackendFilter;
use yii\web\Controller;

class BaseController extends Controller
{
    public function behaviors(){
        return [
            'myFilter'=>[
                'class'=>BackendFilter::className(),
            ]
        ];
    }

}