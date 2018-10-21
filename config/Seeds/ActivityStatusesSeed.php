<?php
use Migrations\AbstractSeed;

/**
 * ActivityStatuses seed.
 */
class ActivityStatusesSeed extends AbstractSeed
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
                'status' => 'Active',
            ],
            [
                'id' => '2',
                'status' => 'Cancelled',
            ],
            [
                'id' => '3',
                'status' => 'Completed',
            ],
        ];

        $table = $this->table('activity_statuses');
        $table->insert($data)->save();
    }
}
