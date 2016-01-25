<?php
use Migrations\AbstractMigration;

class AddAddressToReviewCommunities extends AbstractMigration
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
        $table = $this->table('review_communities');
        $table->addColumn('country_id', 'integer', ['limit' => 11, 'after' => 'user_id'])
              ->addColumn('ken_id', 'integer', ['limit' => 11, 'after' => 'country_id']) // ad_address.ken_id 都道府県
              ->addColumn('city_id', 'integer', ['limit' => 11, 'after' => 'ken_id']); // ad_address.city_id 市町村
        $table->addColumn('hometown_country_id', 'integer', ['limit' => 11, 'after' => 'city_id'])
              ->addColumn('hometown_ken_id', 'integer', ['limit' => 11, 'after' => 'hometown_country_id']) // ad_address.ken_id 都道府県
              ->addColumn('hometown_city_id', 'integer', ['limit' => 11, 'after' => 'hometown_ken_id']); // ad_address.city_id 市町村
        $table->addColumn('name', 'string', ['limit' => 100, 'after' => 'community_status_id']);

        $table->update();
    }
}
