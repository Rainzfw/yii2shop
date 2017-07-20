<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-category-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'intro')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sort')->textInput() ?>
    <?= $form->field($model, 'status')->radioList(\common\models\ArticleCategory::getStatusarr(false)) ?>
    <?= $form->field($model, 'is_help')->radioList(\common\models\ArticleCategory::$ishelparr) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
