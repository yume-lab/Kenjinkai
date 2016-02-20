<?php
use Migrations\AbstractMigration;

class ChangeAgeLimitToCommunitySettings extends AbstractMigration
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
        $table->addColumn('generation', 'integer', ['limit' => 2, 'after' => 'gender']);
        $table->removeColumn('lower_age');
        $table->removeColumn('upper_age');
        $table->update();
    }
}
