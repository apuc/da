<?php

use yii\db\Migration;

/**
 * Class m180925_084648_change_inst_photos_table
 */
class m180925_084648_change_inst_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('inst_photos', 'dt_add', $this->string(100));
        $this->addColumn('inst_photos', 'dt_publish', $this->string(100));
        $this->dropColumn('inst_photos', 'pub_date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('inst_photos', 'dt_add');
        $this->dropColumn('inst_photos', 'dt_publish');
        $this->addColumn('inst_photos', 'pub_date',$this->string());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180925_084648_change_inst_photos_table cannot be reverted.\n";

        return false;
    }
    */
}
