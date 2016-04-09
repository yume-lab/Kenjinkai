<?php
use Migrations\AbstractMigration;

class CommunityCategories extends AbstractMigration
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
        $table = $this->table('community_categories');
        $table->addColumn('name', 'string', ['limit' => 50])
              ->addColumn('is_deleted', 'boolean', ['default' => false])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->create();

        $query = 'INSERT INTO community_categories (`name`, `is_deleted`, `created`, `modified`)
                    VALUES ("%s", 0, NOW(), NOW());';
        $this->execute(sprintf($query, '音楽'));
        $this->execute(sprintf($query, '映画'));
        $this->execute(sprintf($query, '芸能人・テレビ'));
        $this->execute(sprintf($query, 'ゲーム'));
        $this->execute(sprintf($query, '本・マンガ'));
        $this->execute(sprintf($query, 'アート'));
        $this->execute(sprintf($query, 'スポーツ'));
        $this->execute(sprintf($query, '車・バイク'));
        $this->execute(sprintf($query, '旅行'));
        $this->execute(sprintf($query, 'ホーム・DIY'));
        $this->execute(sprintf($query, '動物・ペット'));
        $this->execute(sprintf($query, 'PC／インターネット'));
        $this->execute(sprintf($query, 'ファッション'));
        $this->execute(sprintf($query, 'グルメ・お酒'));
        $this->execute(sprintf($query, '趣味全般'));
        $this->execute(sprintf($query, '生活'));
        $this->execute(sprintf($query, '美容・健康'));
        $this->execute(sprintf($query, '家事・育児'));
        $this->execute(sprintf($query, '地域'));
        $this->execute(sprintf($query, '学校'));
        $this->execute(sprintf($query, '会社・団体'));
        $this->execute(sprintf($query, '職業・資格'));
        $this->execute(sprintf($query, 'ビジネス・経済'));
    }
}
