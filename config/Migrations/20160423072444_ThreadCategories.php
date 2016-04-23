<?php
use Migrations\AbstractMigration;

class ThreadCategories extends AbstractMigration
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
        $table = $this->table('thread_categories');
        $table->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->create();

        $query = 'INSERT INTO thread_categories (`name`, `is_deleted`, `created`, `modified`)
                    VALUES ("%s", 0, NOW(), NOW());';
        $this->execute(sprintf($query, 'イベント'));
        $this->execute(sprintf($query, '雑談'));
    }
}
