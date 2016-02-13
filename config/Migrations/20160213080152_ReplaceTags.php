<?php
use Migrations\AbstractMigration;

class ReplaceTags extends AbstractMigration
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
        $table = $this->table('replace_tags');
        $table->addColumn('tag', 'string', ['limit' => 50])
              ->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('table_name', 'string', ['limit' => 50])
              ->addColumn('column_name', 'string', ['limit' => 50])
              ->addColumn('is_usable', 'boolean', ['default' => false]) // 管理画面でも利用可能か
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['tag'], ['unique' => true])
              ->create();

        // 初期値. 使いそうなものをとりあえずいれておく
        $query = '
        INSERT INTO replace_tags
            (tag, name, table_name, column_name, is_usable, is_deleted, created, modified)
        VALUES
            ("%s", "%s", "%s", "%s", "%s", 0, NOW(), NOW());';

        $data = ['[[nickname]]', 'ニックネーム', 'UserProfiles', 'nickname', true];
        $this->execute(vsprintf($query, $data));

        $data = ['[[birthday]]', '生年月日', 'UserProfiles', 'birthday', true];
        $this->execute(vsprintf($query, $data));

        $data = ['[[comment]]', 'コミュニティ審査コメント', 'ReviewCommunities', 'comment', false];
        $this->execute(vsprintf($query, $data));
    }
}
