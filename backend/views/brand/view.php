<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-view">
    <p>
        <?= Html::a('编辑', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'intro:ntext',
            [
                'attribute'=>'logo',
                'value'=>function($model){
                    return Html::img('http://img.yii2shop.cn'.$model->logo,['style'=>'width:80px;']);
                },
                'format'=>'raw'
            ],
            'sort',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->statustext;
                },
            ]
        ],
    ]) ?>

</div>
