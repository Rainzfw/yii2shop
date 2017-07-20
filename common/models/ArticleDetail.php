<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_detail".
 *
 * @property string $article_id
 * @property string $content
 */
class ArticleDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'required'],
            [['article_id'], 'integer'],
            [['content'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => '文章ID',
            'content' => '内容',
        ];
    }
    public function add($article_id){
        $this->article_id=$article_id;
        return $this->save();
    }
}
