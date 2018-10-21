<?php
use Migrations\AbstractSeed;

/**
 * SearchTypes seed.
 */
class SearchTypesSeed extends AbstractSeed
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
                'type' => 'Activity',
            ],
            [
                'id' => '2',
                'type' => 'Event',
            ],
            [
                'id' => '3',
                'type' => 'Location',
            ],
            [
                'id' => '4',
                'type' => 'User',
            ],
        ];

        $table = $this->table('search_types');
        $table->insert($data)->save();
    }
}
