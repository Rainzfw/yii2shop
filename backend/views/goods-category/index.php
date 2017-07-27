<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-category-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute'=>'name',
                'value'=>function($model){
                    return str_repeat('------',$model->depth).$model->name;
                },
                'format'=>'raw'
            ],
            'intro',
            'create_time:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template'=>'{view}{update}{delete}',
                'buttons'=>[
                    'delete'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','删除'),
                            'aria-label'=>Yii::t('yii','删除'),
                            'data-confirm'=>Yii::t('yii','你确定删除么?'),
                            'data-method'=>'post',
                            'data-pjax'=>'0',
                        ];
                        return Html::a("<span class='glyphicon glyphicon-trash'></span>",$url,$options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
