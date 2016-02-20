<?php
use Migrations\AbstractMigration;

class CommunitySettings extends AbstractMigration
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
        $table->addColumn('community_id', 'integer', ['limit' => 11])
              ->addColumn('gender', 'integer', ['limit' => 1, 'null' => true]) // 値はconfig/app.phpに記載
              ->addColumn('lower_age', 'integer', ['limit' => 4, 'null' => true])
              ->addColumn('upper_age', 'integer', ['limit' => 4, 'null' => true])
              ->addColumn('column_name', 'string', ['limit' => 50])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['community_id'], ['unique' => true])
              ->create();
    }
}
