<?php
use Migrations\AbstractMigration;

class ReviewCommunities extends AbstractMigration
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
        $table = $this->table('review_communities');
        $table->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('community_status_id', 'integer', ['limit' => 11])
              ->addColumn('message', 'text')
              ->addColumn('comment', 'text')
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['user_id'], ['unique' => false])
              ->create();
    }
}
