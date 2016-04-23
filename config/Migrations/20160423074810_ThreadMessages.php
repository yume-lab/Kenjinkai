<?php
use Migrations\AbstractMigration;

class ThreadMessages extends AbstractMigration
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
        $table = $this->table('thread_messages');
        $table->addColumn('thread_id', 'integer', ['limit' => 11])
              ->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('sequence', 'integer', ['limit' => 11]) // スレッド内番号
              ->addColumn('parent_sequence', 'integer', ['limit' => 11, 'null' => true])
              ->addColumn('content', 'text')
              ->addColumn('ip_address', 'string', ['limit' => 30])
              ->addColumn('user_agent', 'text')
              ->addColumn('posted', 'datetime')
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->create();
      }
}
