<?php
use Migrations\AbstractMigration;

class AddCategoryToCommunityThreads extends AbstractMigration
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
        $table->addColumn('thread_category_id', 'integer', ['limit' => 11, 'after' => 'community_id']);
        $table->update();
    }
}
