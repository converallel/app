<?php
use Migrations\AbstractSeed;

/**
 * Transportation seed.
 */
class TransportationSeed extends AbstractSeed
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
                'mode' => 'Foot',
            ],
            [
                'id' => '2',
                'mode' => 'Bicycle',
            ],
            [
                'id' => '3',
                'mode' => 'Motorcycle',
            ],
            [
                'id' => '4',
                'mode' => 'Car',
            ],
            [
                'id' => '5',
                'mode' => 'Train',
            ],
            [
                'id' => '6',
                'mode' => 'Ship',
            ],
            [
                'id' => '7',
                'mode' => 'Airplane',
            ],
        ];

        $table = $this->table('transportation');
        $table->insert($data)->save();
    }
}
