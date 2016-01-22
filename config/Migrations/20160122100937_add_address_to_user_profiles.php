<?php
use Migrations\AbstractMigration;

class AddAddressToUserProfiles extends AbstractMigration
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
        $table->addColumn('country_id', 'integer', ['limit' => 11, 'after' => 'user_id'])
              ->addColumn('prefectures_id', 'integer', ['limit' => 11, 'after' => 'country_id']) // ad_address.ken_id 都道府県
              ->addColumn('city_id', 'integer', ['limit' => 11, 'after' => 'prefectures_id']); // ad_address.city_id 市町村
        $table->update();
    }
}
