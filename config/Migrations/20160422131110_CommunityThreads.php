<?php
use Migrations\AbstractMigration;

class CommunityThreads extends AbstractMigration
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
        $table = $this->table('community_threads');
        $table->addColumn('community_id', 'integer', ['limit' => 11])
              ->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('description', 'text')
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->create();
    }
}
