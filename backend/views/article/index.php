<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'attribute'=>'article_category_id',
                'value'=>'articleCategory.name',
                'filter'=>\common\models\ArticleCategory::find()->select(['name','id'])->indexBy('id')->column()
            ],
            [
                'attribute'=>'status',
                'value'=>'statustext'
            ],
            [
                'attribute'=>'sort',
                'headerOptions' => ['style' => 'colspan:2'],
            ],
            'create:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
            ],
        ],
    ]); ?>
</div>
