<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Goods */

$this->title =$goods_id.'相册';
$this->params['breadcrumbs'][] = ['label' => '商品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-gallery">
    <p>
        <!--定义一个外部标签-->
        <?=Html::fileInput('img',null,['id'=>'img'])?>
    </p>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute'=>'img_url',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::img('http://img.yii2shop.cn'.$model->img_url,['style'=>'width:100px']);
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{gallery-delete}',
                'header' => '操作',
                'buttons'=>[
                    'gallery-delete'=>function($url,$model,$key){
                        $options=[
                            'title'=>Yii::t('yii','删除'),
                            'aria-label'=>Yii::t('yii','删除'),
                            'data-confirm'=>Yii::t('yii','你确定删除么?'),
                            'data-method'=>'post',
                            'data-pjax'=>'0',
                        ];
                        return Html::a("<span class='glyphicon glyphicon-trash'></span>",$url,$options);
                    },
                ],
            ],
        ],
    ]); ?>
</div>

<!--上传小部件主体-->
<?=\flyok666\uploadifive\Uploadifive::widget([
    'url' => yii\helpers\Url::to(['upload/g-upload','goods_id'=>$goods_id]),//图片上传的地址
    'id' => 'img',//插件承载的主体
    'csrf' => true,//是否csrf验证
    'renderTag' => false,
    'jsOptions' => [
        'formData'=>['someKey' => 'someValue'],
        'width' => 120,//上传文件插件样式
        'height' => 40,
        //上传失败需要处理的
        'onError' => new \yii\web\JsExpression(<<<EOF
                function(file, errorCode, errorMsg, errorString) {
                    console.log('The file ' + file.name + ' could not be uploaded: ' + errorString + errorCode + errorMsg);
                }
EOF
        ),
        //上传完成需要处理的
        'onUploadComplete' => new \yii\web\JsExpression(<<<EOF
                function(file, data, response) {
                    data = JSON.parse(data);
                    if (data.error) {
                        console.log(data.msg);
                    } else {
                        //回显图片
                        $('table tbody').append('<tr><td><img src="http://img.yii2shop.cn'+data.fileUrl+'" alt="" style="width:100px"></td><td><a href="/index.php?r=goods%2Fdelete&amp;gallery_id='+data.id+'" title="删除" aria-label="删除" data-confirm="你确定删除么?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>');
                        console.log(data.fileUrl);
                    }
                }
EOF
        ),
    ]
]);?>

