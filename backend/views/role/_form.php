<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'description')->textInput() ?>
    <?= $form->field($model, 'permissions')->checkboxList(\yii\helpers\ArrayHelper::map(Yii::$app->authManager->getPermissions(),'name','description')) ?>
    <div class="form-group">
        <?= Html::submitButton(1 ? 'Create' : 'Update', ['class' => 1? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
