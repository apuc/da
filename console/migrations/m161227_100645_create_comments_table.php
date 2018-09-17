<?php

use yii\db\Migration;

/**
 * Handles the creation for table `comments`.
 */
class m161227_100645_create_comments_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable( 'comments', [
            'id'        => $this->primaryKey(),
            'post_type' => $this->string( 64 ),
            'post_id'   => $this->integer( 11 ),
            'user_id'   => $this->integer( 11 ),
            'content'   => $this->text(),
            'dt_add'    => $this->integer( 11 ),
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable( 'comments' );
    }
}
