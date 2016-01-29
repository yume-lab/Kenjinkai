<?php
use Migrations\AbstractMigration;

class UserInformations extends AbstractMigration
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
        $table = $this->table('user_informations');
        $table->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('information_id', 'integer', ['limit' => 11])
              ->addColumn('convert_info', 'string', ['limit' => 100, 'null' => true]) // 変換情報. JSONで持つ
              ->addColumn('read_date', 'datetime', ['null' => true])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['user_id'])
              ->addIndex(['information_id'])
              ->create();
    }
}
