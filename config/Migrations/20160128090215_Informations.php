<?php
use Migrations\AbstractMigration;

class Informations extends AbstractMigration
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
        $table->addColumn('information_type_id', 'integer', ['limit' => 11])
              ->addColumn('path', 'string', ['limit' => 50])
              ->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('content', 'text')
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['path'], ['unique' => true])
              ->create();
    }
}
