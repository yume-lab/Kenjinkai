<?php
use Migrations\AbstractMigration;

class RenameAddressColumns extends AbstractMigration
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
        $table->renameColumn('prefectures_id', 'ken_id');

        $table = $this->table('user_profiles');
        $table->renameColumn('prefectures_id', 'ken_id');
    }
}
