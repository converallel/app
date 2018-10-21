<?php
use Migrations\AbstractSeed;

/**
 * Personalities seed.
 */
class PersonalitiesSeed extends AbstractSeed
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
                'type' => 'ENFJ',
            ],
            [
                'id' => '2',
                'type' => 'ENFP',
            ],
            [
                'id' => '3',
                'type' => 'ENTJ',
            ],
            [
                'id' => '4',
                'type' => 'ENTP',
            ],
            [
                'id' => '5',
                'type' => 'ESFJ',
            ],
            [
                'id' => '6',
                'type' => 'ESFP',
            ],
            [
                'id' => '7',
                'type' => 'ESTJ',
            ],
            [
                'id' => '8',
                'type' => 'ESTP',
            ],
            [
                'id' => '9',
                'type' => 'INFJ',
            ],
            [
                'id' => '10',
                'type' => 'INFP',
            ],
            [
                'id' => '11',
                'type' => 'INTJ',
            ],
            [
                'id' => '12',
                'type' => 'INTP',
            ],
            [
                'id' => '13',
                'type' => 'ISFJ',
            ],
            [
                'id' => '14',
                'type' => 'ISFP',
            ],
            [
                'id' => '15',
                'type' => 'ISTJ',
            ],
            [
                'id' => '16',
                'type' => 'ISTP',
            ],
        ];

        $table = $this->table('personalities');
        $table->insert($data)->save();
    }
}
