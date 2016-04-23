<?php
use Migrations\AbstractMigration;

class ChangeTextToUserInformations extends AbstractMigration
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
        $table->changeColumn('convert_info', 'text', ['null' => true]) // 変換情報. JSONで持つ
              ->update();
    }
}
