<?php

use yii\db\Migration;

class m170731_021544_create_table_menu extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170731_021544_create_table_menu cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull()->unique(),
            'description' => $this->string(255)->notNull(),
            'parent_id' => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'route' => $this->string(200)->defaultValue(''),
            'icon' => $this->string(200)->defaultValue('file-code-o'),
            'lavel'=>$this->smallInteger()->unsigned()->defaultValue(0),
            'created_at' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull()->defaultValue(0)
        ], $tableOptions);

    }

    public function down()
    {
        echo "m170731_021544_create_table_menu cannot be reverted.\n";

        return false;
    }

}
