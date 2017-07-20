<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCategory */

$this->title = '文章分类管理: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '文章分类管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '编辑';
?>
<div class="article-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
