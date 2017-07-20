<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

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
                'attribute'=> 'intro',
                'value'=>function($model){
                    if(mb_strlen($model->intro)>10){
                        return mb_substr($model->intro,0,10).'...';
                    }
                    return $model->intro.'...';
                }
            ],
            'sort',
            [
                'attribute'=>'status',
                'value'=>'statustext',
                'filter'=>\common\models\ArticleCategory::getStatusarr(),
                'contentOptions'=>function($model){
                    return $model->status == 3 ? ['class'=>'bg-danger']:[];
                }
            ],
            [
                'attribute'=>'is_help',
                'value'=>'ishelptext',
                'filter'=>\common\models\ArticleCategory::$ishelparr
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}{update}{delete}',
                'buttons'=>[
                    'delete'=>function($url,$model,$key){
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
