<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/28
 * Time: 9:14
 */

namespace backend\controllers;


use backend\models\Permisssion;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class PermissionController extends Controller
{
    //添加权限
    public function actionCreate(){
        $model = new Permisssion();
        if(\Yii::$app->request->isPost){
            if($model->load(\Yii::$app->request->post())){
                //创建权限对象
                $authManager = \Yii::$app->authManager;
                //判断添加的权限是否存在
                if($authManager->getPermission($model->name)){
                    throw new HttpException('权限['.$model->name.']已存在!');
                }
                $permission = $authManager->createPermission($model->name);
                $permission->description = $model->description;
                //添加权限
                $authManager->add($permission);
                \Yii::$app->session->setFlash('添加成功!');
                return $this->redirect(['index']);
            }
        }
        return $this->render('create',['model'=>$model]);
    }
    //编辑权限
    public function actionUpdate($id){
        $model = new Permisssion();
        $authManager = \Yii::$app->authManager;
        $permission = $authManager->getPermission($id);
        if(\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())){
            if($model->name !=$id && $authManager->getPermission($model->name)){
                throw new HttpException('权限名称已存在!');
            }elseif($model->name!=$id){
                $permission->name=$model->name;
            }
            $permission->description=$model->description;
            $authManager->update($id,$permission);
            \Yii::$app->session->setFlash('编辑成功!');
            return $this->redirect(['index']);
        }
        $model->loadPermission($permission);
        return $this->render('update',['model'=>$model]);

    }
    //删除权限
    public function actionDelete($id){
        $authManager = \Yii::$app->authManager;
        $permission = $authManager->getPermission($id);
        if(!$permission){
            throw new NotFoundHttpException('权限不存在'.$id);
        }
        $authManager->remove($permission);
        \Yii::$app->session->setFlash('删除成功!');
        return $this->redirect(['index']);
    }
    //权限列表
    public function actionIndex(){
        $provider = new ArrayDataProvider([
            'allModels' => \Yii::$app->authManager->getPermissions(),
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        //var_dump(\Yii::$app->authManager->getPermissions());exit;
        return $this->render('index',['dataProvider'=>$provider]);
    }

}