<?php

namespace backend\controllers;

use common\models\ArticleDetail;
use Yii;
use common\models\Article;
use backend\models\ArticleSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $amodel = new Article();
        $admodel = new ArticleDetail();
        if(Yii::$app->request->isPost){
            $tr = Yii::$app->db->beginTransaction();
            //这里使用事务关联
            try{
                //添加文章表
                if(!$amodel->load(Yii::$app->request->post()) || !$amodel->save()){
                    throw new Exception('添加文章表失败!');
                }
                if(!$admodel->load(Yii::$app->request->post()) || !$admodel->add($amodel->id)){
                    throw new Exception('添加文章详情失败!');
                }
                $tr->commit();
                return $this->redirect(['view', 'id' => $amodel->id]);
            }catch(Exception $e){
                $tr->rollBack();
                throw new HttpException($e->getMessage());
            }
        }
        return $this->render('create', [
            'amodel' => $amodel,
            'admodel'=>$admodel
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {


        $amodel = Article::findOne($id);
        $admodel = ArticleDetail::findOne($id);
        if(!$amodel || !$admodel){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        if(Yii::$app->request->isPost){
            $tr = Yii::$app->db->beginTransaction();
            //这里使用事务关联
            try{
                //添加文章表
                if(!$amodel->load(Yii::$app->request->post()) || !$amodel->save()){
                    throw new Exception('修改文章表失败!');
                }
                if(!$admodel->load(Yii::$app->request->post()) || !$admodel->save()){
                    throw new Exception('修改文章详情失败!');
                }
                $tr->commit();
                return $this->redirect(['view', 'id' => $amodel->id]);
            }catch(Exception $e){
                $tr->rollBack();
                echo $e->getMessage();exit;
            }
        }
        return $this->render('update', [
                'amodel' => $amodel,
                'admodel' => $admodel
        ]);

    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = Article::findOne($id);
        $model->status=3;
        $model->save();
        Yii::$app->session->setFlash('删除成功');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
