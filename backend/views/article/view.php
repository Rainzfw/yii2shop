<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            [
                'attribute'=>'article_category_id',
                'value'=>function($model){
                    return $model->articleCategory->name;
                }

            ],
            [
                'attribute'=>'content',
                'format'=>'raw',
                'value'=>function($model){
                    return $model->articleDetail->content;
                }

            ],
            'sort',
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model->statustext;
                }
            ],
            'create:datetime',
        ],
    ]) ?>

</div>
