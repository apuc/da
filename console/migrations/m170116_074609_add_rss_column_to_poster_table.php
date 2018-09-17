<?php

use yii\db\Migration;

/**
 * Handles adding rss to table `poster`.
 */
class m170116_074609_add_rss_column_to_poster_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->addColumn( 'poster', 'rss', $this->integer( 1 )->defaultValue( 0 ) );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn( 'poster', 'rss' );
    }
}
