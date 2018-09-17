<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site_meta_params`.
 */
class m170117_111534_create_site_meta_params_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable( 'site_meta_params', [
            'id'                   => $this->primaryKey(),
            'site_addable_meta_id' => $this->integer( 11 ),
            'key'                  => $this->string( 64 ),
            'value'                => $this->text()
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable( 'site_meta_params' );
    }
}
