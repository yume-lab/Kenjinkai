<?php
use Migrations\AbstractMigration;

class InformationTypes extends AbstractMigration
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
        $table = $this->table('information_types');
        $table->addColumn('alias', 'string', ['limit' => 20])
              ->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['alias'], ['unique' => true])
              ->create();

        $query = 'INSERT INTO information_types (`alias`, `name`, `is_deleted`, `created`, `modified`)
                    VALUES ("%s", "%s", 0, NOW(), NOW());';
        $this->execute(vsprintf($query, ['admin', '管理者通知']));
        $this->execute(vsprintf($query, ['notice', 'ユーザー通知(プログラムから)']));
    }
}
