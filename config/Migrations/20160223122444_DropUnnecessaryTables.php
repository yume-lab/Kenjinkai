<?php
use Migrations\AbstractMigration;

class DropUnnecessaryTables extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('replace_tags');
        $table->drop();
        $table = $this->table('community_images');
        $table->drop();
    }
}
