<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/31
 * Time: 17:06
 */

namespace backend\filters;


use yii\base\ActionFilter;
use yii\web\ForbiddenHttpException;

class BackendFilter extends ActionFilter
{
    public function beforeAction($action){
        //判断用户是否登录
        if(\Yii::$app->user->isGuest){
            \Yii::$app->session->setFlash('请先登录!');
            return $action->controller->redirect(['login/login']);
        }
        if(!\Yii::$app->user->can($action->uniqueId)){
            throw new ForbiddenHttpException('没有权限!');
        }
        return parent::beforeAction($action);
    }

}