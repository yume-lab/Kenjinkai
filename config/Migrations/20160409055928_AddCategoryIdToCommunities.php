<?php
use Migrations\AbstractMigration;

class AddCategoryIdToCommunities extends AbstractMigration
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
        $table = $this->table('communities');
        $table->addColumn('community_category_id', 'integer', ['limit' => 11, 'after' => 'community_status_id']);
        $table->update();
    }
}
