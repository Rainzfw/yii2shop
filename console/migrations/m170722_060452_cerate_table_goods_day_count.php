<?php

use yii\db\Migration;

class m170722_060452_cerate_table_goods_day_count extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170722_060452_cerate_table_goods_day_count cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='商品每日添加数'";
        }
        $this->createTable('goods_day_count',[
            'day'=>$this->string(30)->comment('日期'),
            'count'=>$this->integer()->unsigned()->notNull()->comment('上级分类'),
        ],$tableOptions);
        $this->addPrimaryKey('daykey','goods_day_count','day');

    }

    public function down()
    {
        echo "m170722_060452_cerate_table_goods_day_count cannot be reverted.\n";

        return false;
    }

}
