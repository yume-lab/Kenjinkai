<?php
use Migrations\AbstractMigration;

class RemoveColumnNameToCommunitySettings extends AbstractMigration
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
        $table = $this->table('community_settings');
        $table->removeColumn('column_name');
        $table->removeColumn('generation');
        $table->addColumn('generation', 'integer', ['limit' => 2, 'after' => 'gender', 'null' => true]);
        $table->update();
    }
}
