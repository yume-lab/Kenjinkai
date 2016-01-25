<?php
use Migrations\AbstractMigration;

class Admins extends AbstractMigration
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
        $table = $this->table('admins');
        $table->addColumn('email', 'string', ['limit' => 50])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('name', 'string', ['limit' => 100])
              ->addColumn('registered', 'datetime')
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }
}
