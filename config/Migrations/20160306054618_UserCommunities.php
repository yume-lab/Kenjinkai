<?php
use Migrations\AbstractMigration;

class UserCommunities extends AbstractMigration
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
        $table = $this->table('user_communities');
        $table->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('community_id', 'integer', ['limit' => 11])
              ->addColumn('community_role_id', 'integer', ['limit' => 11])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['user_id'])
              ->addIndex(['community_id'])
              ->create();
    }
}
