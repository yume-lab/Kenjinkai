<?php
use Migrations\AbstractMigration;

class CommunityStatuses extends AbstractMigration
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
        $table = $this->table('community_statuses');
        $table->addColumn('alias', 'string', ['limit' => 20])
              ->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['alias'], ['unique' => true])
              ->create();

        $query = 'INSERT INTO community_statuses (`alias`, `name`, `is_deleted`, `created`, `modified`)
                    VALUES ("%s", "%s", 0, NOW(), NOW());';
        $this->execute(vsprintf($query, ['review', '審査中']));
        $this->execute(vsprintf($query, ['success', '審査OK']));
        $this->execute(vsprintf($query, ['failure', '審査NG']));
        $this->execute(vsprintf($query, ['publish', '公開中']));
    }
}
