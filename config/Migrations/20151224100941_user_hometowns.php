<?php
use Migrations\AbstractMigration;

class UserHometowns extends AbstractMigration
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
        $table = $this->table('user_hometowns');
        $table->addColumn('user_id', 'integer', ['limit' => 11])
              ->addColumn('country_id', 'integer', ['limit' => 11])
              ->addColumn('prefectures_id', 'integer', ['limit' => 11]) // ad_address.ken_id 都道府県
              ->addColumn('city_id', 'integer', ['limit' => 11]) // ad_address.city_id 市町村
              ->addColumn('memories', 'text')
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['user_id'], ['unique' => true])
              ->create();
    }
}
