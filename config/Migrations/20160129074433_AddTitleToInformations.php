<?php
use Migrations\AbstractMigration;

class AddTitleToInformations extends AbstractMigration
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
        $table = $this->table('informations');
        $table->addColumn('title', 'string', ['limit' => 50]);
        $table->update();
    }
}
