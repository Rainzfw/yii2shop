<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = '修改';
$this->params['breadcrumbs'][] = ['label' => '权限管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="admin-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
