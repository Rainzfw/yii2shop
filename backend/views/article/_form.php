<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($amodel, 'name')->textInput(['maxlength' => true]) ?>
    <?php $article_category_ids = \common\models\ArticleCategory::find()->select(['name','id'])->indexBy('id')->column()?>
    <?= $form->field($amodel, 'article_category_id')->dropDownList($article_category_ids) ?>
    <?= $form->field($admodel, 'content')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //设置语言
            'lang' =>'zh-cn', //中文为 zh-cn
            'serverUrl'=>\yii\helpers\Url::to(['upload/u-upload']),//图片上传的地址
            //定制菜单
            'toolbars' => [
                [
                    'fullscreen', 'source', 'undo', 'redo', '|',
                    'fontsize',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                    'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                    'forecolor', 'backcolor', '|',
                    'lineheight', '|',
                    'indent', '|','simpleupload','insertimage', 'emotion', 'scrawl',
                ],
            ]
        ]
    ]) ?>
    <?= $form->field($amodel, 'status')->radioList(\common\models\Article::getStatusarr(false)) ?>
    <?= $form->field($amodel, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($amodel->isNewRecord ? 'Create' : 'Update', ['class' => $amodel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
