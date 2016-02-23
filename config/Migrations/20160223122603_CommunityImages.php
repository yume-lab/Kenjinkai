<?php
use Migrations\AbstractMigration;

class CommunityImages extends AbstractMigration
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
        $table = $this->table('community_images');
        $table->addColumn('community_id', 'integer', ['limit' => 11])
              ->addColumn('hash', 'string', ['limit' => 255])
              ->addColumn('name', 'string') // オリジナルファイル名
              ->addColumn('extension', 'string', ['limit' => 10]) // ファイル名は hash+extension
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['community_id'])
              ->addIndex(['hash'], ['unique' => true])
              ->create();
    }
}
