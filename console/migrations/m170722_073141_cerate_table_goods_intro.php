<?php

use yii\db\Migration;

class m170722_073141_cerate_table_goods_intro extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170722_073141_cerate_table_goods_intro cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='��Ʒ�����'";
        }
        $this->createTable('goods_intro',[
            'goods_id'=>$this->integer()->unsigned()->notNull()->comment('��Ʒid'),
            'content'=>$this->text()->comment('��Ʒ����')
        ],$tableOptions);
        $this->addPrimaryKey('gid','goods_intro','goods_id');

    }

    public function down()
    {
        echo "m170722_073141_cerate_table_goods_intro cannot be reverted.\n";

        return false;
    }

}
