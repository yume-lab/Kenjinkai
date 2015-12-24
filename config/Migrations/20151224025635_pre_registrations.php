<?php
use Migrations\AbstractMigration;

class PreRegistrations extends AbstractMigration
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
        $table = $this->table('pre_registrations');
        $table->addColumn('email', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('hash', 'string', ['limit' => 100, 'null' => false])
              ->addColumn('registered', 'datetime')
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['email', 'hash'], ['unique' => true])
              ->create();
    }
}
