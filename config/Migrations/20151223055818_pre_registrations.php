<?php
use Migrations\AbstractMigration;

class PreRegistrations extends AbstractMigration
{

    /**
     * テーブルの定義
     * @return void
     */
    public function change()
    {
        $table = $this->table('pre_registrations');
        $table->addColumn('email', 'string', ['limit' => 50, 'null' => false])
              ->addColumn('hash', 'string', ['limit' => 100, 'null' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(array('email', 'hash'), array('unique' => true))
              ->create();
    }
}
