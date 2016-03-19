<?php
use Migrations\AbstractMigration;

class ChangeColumnToUserImages extends AbstractMigration
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
        $table = $this->table('user_images');
        $table->renameColumn('uesr_id', 'user_id');
        $table->update();
    }
}
