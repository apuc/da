<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company_feedback`.
 */
class m170419_202018_create_company_feedback_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_feedback', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'company_name' => $this->string(255),
            'feedback' => $this->text()->notNull(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company_feedback');
    }
}
