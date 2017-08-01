<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">
    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'description',
             'createdAt:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                'header' => '操作',
                'buttons'=>[
                    'delete'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','删除'),
                            'aria-label'=>Yii::t('yii','删除'),
                            'data-confirm'=>Yii::t('yii','你确定删除么?'),
                            //'data-method'=>'post',
                            'data-pjax'=>'0',
                        ];
                        return Html::a("<span class='glyphicon glyphicon-trash'></span>",$url,$options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
