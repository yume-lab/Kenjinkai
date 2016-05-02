<?php
use Migrations\AbstractMigration;

class AddAuthColumnToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('reset_password_hash', 'string', ['limit' => 255, 'after' => 'exited', 'null' => true])
              ->addColumn('password_reset_at', 'datetime', ['after' => 'reset_password_hash', 'null' => true])
              ->addColumn('last_login_at', 'datetime', ['after' => 'password_reset_at', 'null' => true])
              ->addColumn('current_login_at', 'datetime', ['after' => 'last_login_at', 'null' => true]);
        $table->update();
    }
}
