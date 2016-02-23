<?php
use Migrations\AbstractMigration;

class ReAddTypeAndSizeToCommunityImages extends AbstractMigration
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
        $table->removeColumn('mime_type');
        $table->removeColumn('size');
        $table->update();

        $table->addColumn('mime_type', 'string', ['after' => 'name'])
              ->addColumn('size', 'integer', ['after' => 'mime_type']); // バイト数
        $table->update();
    }
}
