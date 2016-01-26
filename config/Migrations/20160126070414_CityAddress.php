<?php
use Migrations\AbstractMigration;

class CityAddress extends AbstractMigration
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
        $table = $this->table('city_address');
        $table->addColumn('ken_id', 'integer', ['limit' => 2])
              ->addColumn('city_id', 'integer', ['limit' => 5])
              ->addColumn('ken_name', 'string', ['limit' => 10])
              ->addColumn('ken_furi', 'string', ['limit' => 10])
              ->addColumn('city_name', 'string', ['limit' => 10])
              ->addColumn('city_furi', 'string', ['limit' => 10])
              ->addColumn('created', 'datetime')
              ->addColumn('modified', 'datetime')
              ->addIndex(['ken_id'])
              ->addIndex(['city_id'])
              ->create();

        $query = <<<EOF
insert into city_address
(
    ken_id,
    ken_name,
    ken_furi,
    city_id,
    city_name,
    city_furi
)
select
    ken_id,
    ken_name,
    ken_furi,
    city_id,
    city_name,
    city_furi
from
    ad_address
where
    delete_flg = 0
and office_flg = 0
group by
    city_id, ken_id;
EOF;
        $this->execute($query);
    }
}
