<?php

use yii\db\Migration;

/**
 * Handles adding sections to table `consulting`.
 */
class m161117_073222_add_sections_column_to_consulting_table extends Migration {
    /**
     * @inheritdoc
     */
    public function up() {
        $this->addColumn( 'consulting', 'about_company', $this->integer( 1 )->defaultValue( 0 ) );
        $this->addColumn( 'consulting', 'documents', $this->integer( 1 )->defaultValue( 0 ) );
        $this->addColumn( 'consulting', 'posts', $this->integer( 1 )->defaultValue( 0 ) );
        $this->addColumn( 'consulting', 'faq', $this->integer( 1 )->defaultValue( 0 ) );
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn( 'consulting', 'about_company' );
        $this->dropColumn( 'consulting', 'documents' );
        $this->dropColumn( 'consulting', 'posts' );
        $this->dropColumn( 'consulting', 'faq' );
    }
}
