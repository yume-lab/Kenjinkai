<?php
use Migrations\AbstractMigration;

class Users extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('email', 'string', ['limit' => 50])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('registered', 'datetime')
              ->addColumn('exited', 'datetime', ['null' => true])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['email'], ['unique' => true])
              ->create();
    }
}
