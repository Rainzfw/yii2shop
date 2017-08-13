<?php

namespace backend\controllers;

use backend\models\ResetPwd;
use Yii;
use backend\models\Admin;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Admin::find(),
            'pagination'=> [
                'pagesize' => '2',
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->roles = ArrayHelper::map(Yii::$app->authManager->getRoles(),'name','name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);
        $model->status=Admin::STATUS_DELETED;
        $model->save(false);
        return $this->redirect(['index']);
    }
    //重置密码 登录的用户可以重置自己的密码
    public function actionResetPwd(){
        if(!Yii::$app->user->identity){
            throw new HttpException('未登录!');
        }
        $model =new ResetPwd();
        $adminModel = Admin::findOne(Yii::$app->user->identity->id);
        //$adminModel = Admin::findOne(1);
        if(Yii::$app->request->isPost){
            if($model->load(Yii::$app->request->post())){
                if(!$model->new_password1 === $model->new_password2){
                    throw new HttpException('密码不一致!');
                }
                //重置密码的model
                if(!$adminModel->validatePassword($model->old_password)){
                    throw new HttpException('输入的原密码错误!');
                }
                $adminModel->password=$model->new_password1;
                $adminModel->save(false);
                Yii::$app->session->setFlash('修改密码成功!');
                return $this->redirect(['login/login']);
            }

        }

        return $this->render('reset_pwd',['model'=>$model,'adminModel'=>$adminModel]);
    }
    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {

        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
