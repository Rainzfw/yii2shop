<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'logo')->hiddenInput(['id'=>'logo'])?>
    <!--定义一个外部标签-->
    <?=Html::fileInput('img',null,['id'=>'img'])?>
    <!--上传小部件主体-->
    <?=\flyok666\uploadifive\Uploadifive::widget([
        'url' => yii\helpers\Url::to(['upload/qiniu-upload']),//图片上传的地址
        'id' => 'img',//插件承载的主体
        'csrf' => true,//是否csrf验证
        'renderTag' => false,
        'jsOptions' => [
            'formData'=>['someKey' => 'someValue'],
            'width' => 120,//上传文件插件样式
            'height' => 40,
            //上传失败需要处理的
            'onError' => new JsExpression(<<<EOF
                function(file, errorCode, errorMsg, errorString) {
                    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
                }
EOF
            ),
            //上传完成需要处理的
            'onUploadComplete' => new JsExpression(<<<EOF
                function(file, data, response) {
                    data = JSON.parse(data);
                    if (data.error) {
                        console.log(data.msg);
                    } else {
                        $('#logo').val(data.fileUrl);
                        if($('#img-logo')){
                            $('#img-logo').attr('src',data.fileUrl);
                        }else{
                             $('#logo').after('<img id="img-logo" src="'+data.fileUrl+'"/>');
                        }

                        console.log(data.fileUrl);
                    }
                }
EOF
            ),
        ]
    ]);?>
    <?php
        if(!$model->isNewRecord && $model->logo){
            echo Html::img($model->logo,['id'=>'img-logo','style'=>'width:80px;']);
        }
    ?>

    <?= $form->field($model, 'sort')->textInput() ?>
    <?= $form->field($model, 'status')->radioList(\common\models\Brand::getStatusarr(false)) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
