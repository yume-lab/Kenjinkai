<?php
use Migrations\AbstractMigration;

class Communities extends AbstractMigration
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
        $table->addColumn('community_status_id', 'integer', ['limit' => 11])
              ->addColumn('country_id', 'integer', ['limit' => 11])
              ->addColumn('ken_id', 'integer', ['limit' => 11]) // ad_address.ken_id 都道府県
              ->addColumn('city_id', 'integer', ['limit' => 11]) // ad_address.city_id 市町村
              ->addColumn('hometown_country_id', 'integer', ['limit' => 11])
              ->addColumn('hometown_ken_id', 'integer', ['limit' => 11]) // ad_address.ken_id 都道府県
              ->addColumn('hometown_city_id', 'integer', ['limit' => 11]) // ad_address.city_id 市町村
              ->addColumn('name', 'string', ['limit' => 100])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['country_id'])
              ->addIndex(['ken_id'])
              ->addIndex(['city_id'])
              ->addIndex(['hometown_country_id'])
              ->addIndex(['hometown_ken_id'])
              ->addIndex(['hometown_city_id'])
              ->create();
    }
}
