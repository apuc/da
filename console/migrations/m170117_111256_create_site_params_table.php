<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site_params`.
 */
class m170117_111256_create_site_params_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable( 'site_params', [
            'id'         => $this->primaryKey(),
            'meta_key'   => $this->string( 64 ),
            'meta_value' => $this->string( 512 ),
            'site'       => $this->string( 64 )
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable( 'site_params' );
    }
}
