<?php

use yii\db\Migration;

class m170722_060615_cerate_table_goods extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170722_060615_cerate_table_goods cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if($this->db->driverName=='mysql'){
            $tableOptions = "character set utf8 collate utf8_general_ci engine=innodb comment='��Ʒ'";
        }
        $this->createTable('goods',[
            'id'=>$this->primaryKey()->comment('��Ʒid'),
            'sn'=>$this->string()->notNull()->comment('��Ʒ����'),
            'name'=>$this->string(20)->notNull()->comment('��Ʒ����'),
            'logo'=>$this->string(100)->notNull()->comment('��Ʒlogo'),
            'goods_cate_id'=>$this->integer()->unsigned()->notNull()->comment('��Ʒ����id'),
            'brand_id'=>$this->integer()->unsigned()->notNull()->comment('Ʒ��id'),
            'shop_price'=>$this->decimal(10,2)->notNull()->defaultValue(0)->comment('����۸�'),
            'market_price'=>$this->decimal(10,2)->notNull()->defaultValue(100)->comment('�г��۸�'),
            'stock'=>$this->integer()->unsigned()->notNull()->comment('���'),
            'is_on_sale'=>$this->smallInteger()->notNull()->defaultValue(1)->comment('1�ϼ�2�¼�'),
            'status'=>$this->smallInteger()->notNull()->defaultValue(1)->comment('1����2ɾ��'),
            'sort'=>$this->integer()->unsigned()->notNull()->comment('����'),
            'create_time'=>$this->integer()->unsigned()->defaultValue(0)->comment('���ʱ��')
        ],$tableOptions);

    }

    public function down()
    {
        echo "m170722_060615_cerate_table_goods cannot be reverted.\n";

        return false;
    }

}
