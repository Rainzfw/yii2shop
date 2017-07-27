<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goods_day_count".
 *
 * @property string $day
 * @property string $count
 */
class GoodsDayCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_day_count';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['day', 'count'], 'required'],
            [['count'], 'integer'],
            [['day'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'day' => 'Day',
            'count' => 'Count',
        ];
    }
}
