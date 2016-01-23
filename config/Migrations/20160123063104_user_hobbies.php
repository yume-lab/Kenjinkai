<?php
use Migrations\AbstractMigration;

class UserHobbies extends AbstractMigration
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
        $table = $this->table('user_hobbies');
        $table->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('content', 'text')
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['user_id'], ['unique' => false])
              ->create();
    }
}
