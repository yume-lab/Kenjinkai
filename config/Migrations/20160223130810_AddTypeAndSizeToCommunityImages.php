<?php
use Migrations\AbstractMigration;

class AddTypeAndSizeToCommunityImages extends AbstractMigration
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
        $table->addColumn('mime_type', 'string')
              ->addColumn('size', 'integer'); // バイト数
        $table->update();
    }
}
