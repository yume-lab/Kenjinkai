<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AdAddressFixture
 *
 */
class AdAddressFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'ad_address';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 9, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ken_id' => ['type' => 'integer', 'length' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'city_id' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'town_id' => ['type' => 'integer', 'length' => 9, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'zip' => ['type' => 'string', 'length' => 8, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'office_flg' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'delete_flg' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'ken_name' => ['type' => 'string', 'length' => 8, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'ken_furi' => ['type' => 'string', 'length' => 8, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'city_name' => ['type' => 'string', 'length' => 24, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'city_furi' => ['type' => 'string', 'length' => 24, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'town_name' => ['type' => 'string', 'length' => 32, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'town_furi' => ['type' => 'string', 'length' => 32, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'town_memo' => ['type' => 'string', 'length' => 16, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'kyoto_street' => ['type' => 'string', 'length' => 32, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'block_name' => ['type' => 'string', 'length' => 64, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'block_furi' => ['type' => 'string', 'length' => 64, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'memo' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'office_name' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'office_furi' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'office_address' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'new_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'ken_id' => 1,
            'city_id' => 1,
            'town_id' => 1,
            'zip' => 'Lorem ',
            'office_flg' => 1,
            'delete_flg' => 1,
            'ken_name' => 'Lorem ',
            'ken_furi' => 'Lorem ',
            'city_name' => 'Lorem ipsum dolor sit ',
            'city_furi' => 'Lorem ipsum dolor sit ',
            'town_name' => 'Lorem ipsum dolor sit amet',
            'town_furi' => 'Lorem ipsum dolor sit amet',
            'town_memo' => 'Lorem ipsum do',
            'kyoto_street' => 'Lorem ipsum dolor sit amet',
            'block_name' => 'Lorem ipsum dolor sit amet',
            'block_furi' => 'Lorem ipsum dolor sit amet',
            'memo' => 'Lorem ipsum dolor sit amet',
            'office_name' => 'Lorem ipsum dolor sit amet',
            'office_furi' => 'Lorem ipsum dolor sit amet',
            'office_address' => 'Lorem ipsum dolor sit amet',
            'new_id' => 1
        ],
    ];
}
