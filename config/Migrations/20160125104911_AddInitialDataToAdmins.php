<?php
use Migrations\AbstractMigration;

class AddInitialDataToAdmins extends AbstractMigration
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
        $table = $this->table('admins');
        $query = 'INSERT INTO admins VALUES (1, "%s", "%s", "%s", now(), 0, NOW(), NOW());';

        // パスワードは,'admin'のハッシュ
        $data = ['sakaguchi@typical-japan.com', '$2y$10$cWmrOrPWh8fbCl.Rzfykx.i2WoPjXKonpTlf0neTHGc7e5MWACKqq', '坂口 雅史'];
        $this->execute(vsprintf($query, $data));

        $table->update();
    }
}
