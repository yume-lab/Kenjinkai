<?php
use Migrations\AbstractMigration;

class UserProfiles extends AbstractMigration
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
        $table = $this->table('user_profiles');
        $table->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('gender', 'integer', ['limit' => 1]) // 値はconfig/app.phpに記載
              ->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('nickname', 'string', ['limit' => 50])
              ->addColumn('birthday', 'string', ['limit' => 8])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['user_id'], ['unique' => true])
              ->create();
    }
}
