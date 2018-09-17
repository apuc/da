<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site_addable_meta`.
 */
class m170117_111702_create_site_addable_meta_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable( 'site_addable_meta', [
            'id'             => $this->primaryKey(),
            'site_params_id' => $this->integer( 11 )
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable( 'site_addable_meta' );
    }
}
