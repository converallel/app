<?php
use Migrations\AbstractSeed;

/**
 * ActivityFilterDateTypes seed.
 */
class ActivityFilterDateTypesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'type' => 'All',
            ],
            [
                'id' => '2',
                'type' => 'Today',
            ],
            [
                'id' => '3',
                'type' => 'Tomorrow',
            ],
            [
                'id' => '4',
                'type' => 'This Weekend',
            ],
            [
                'id' => '5',
                'type' => 'This Week',
            ],
            [
                'id' => '6',
                'type' => 'Next Week',
            ],
            [
                'id' => '7',
                'type' => 'Customized',
            ],
        ];

        $table = $this->table('activity_filter_date_types');
        $table->insert($data)->save();
    }
}
