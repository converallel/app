<?php
use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Initial extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

        $this->table('accounts')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 60,
                'null' => true,
            ])
            ->addColumn('phone_number', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('password', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('failed_login_attempts', 'integer', [
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'email',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'phone_number',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('activities')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('start_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('end_date', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('customized_location', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('organizer_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('is_pair', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('exclusive', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('location_visibility', 'boolean', [
                'comment' => 'NULL - Sub-locality, 1 - Full address, 0 - Hidden',
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('details', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('status_id', 'integer', [
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('group_size_limit', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->addIndex(
                [
                    'organizer_id',
                ]
            )
            ->addIndex(
                [
                    'status_id',
                ]
            )
            ->addIndex(
                [
                    'start_date',
                    'is_pair',
                    'status_id',
                ]
            )
            ->create();

        $this->table('activities_tags')
            ->addColumn('activity_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('tag_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['activity_id', 'tag_id'])
            ->addIndex(
                [
                    'tag_id',
                ]
            )
            ->create();

        $this->table('activities_users')
            ->addColumn('activity_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['activity_id', 'user_id'])
            ->addColumn('type', 'enum', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'values' => ['Interested', 'Participated'],
            ])
            ->addColumn('added_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->addIndex(
                [
                    'added_at',
                ]
            )
            ->create();

        $this->table('activity_applications')
            ->addColumn('activity_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('applicant_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['activity_id', 'applicant_id'])
            ->addColumn('message', 'string', [
                'default' => null,
                'limit' => 200,
                'null' => false,
            ])
            ->addColumn('status', 'enum', [
                'default' => 'TBD',
                'limit' => null,
                'null' => false,
                'values' => ['Approved', 'Rejected', 'TBD'],
            ])
            ->addColumn('applied_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(
                [
                    'applicant_id',
                ]
            )
            ->addIndex(
                [
                    'status',
                ]
            )
            ->create();

        $this->table('activity_filters')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['user_id'])
            ->addColumn('using_current_location', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('distance', 'integer', [
                'default' => '25',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('date_type_id', 'integer', [
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('start_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('end_date', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('from_age', 'integer', [
                'default' => '18',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('to_age', 'integer', [
                'default' => '80',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('matching_personality', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('verified_user', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'date_type_id',
                ]
            )
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->create();

        $this->table('activity_itineraries')
            ->addColumn('activity_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('stop', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['activity_id', 'stop'])
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('arrive_on', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('depart_on', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('transportation_mode_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->addIndex(
                [
                    'transportation_mode_id',
                ]
            )
            ->create();

        $this->table('activity_reviews')
            ->addColumn('activity_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('reviewer_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['activity_id', 'reviewer_id'])
            ->addColumn('rating', 'integer', [
                'comment' => 'On a scale of 1 - 5',
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('review', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('reviewed_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('helpful', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('not_helpful', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'reviewer_id',
                ]
            )
            ->addIndex(
                [
                    'helpful',
                    'reviewed_at',
                ]
            )
            ->create();

        $this->table('activity_statuses')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('status', 'string', [
                'default' => null,
                'limit' => 15,
                'null' => false,
            ])
            ->addIndex(
                [
                    'status',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('blocked_users')
            ->addColumn('blocker_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('blocked_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['blocker_id', 'blocked_id'])
            ->addIndex(
                [
                    'blocked_id',
                ]
            )
            ->create();

        $this->table('devices')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('uuid', 'uuid', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addIndex(
                [
                    'uuid',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('education')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('degree', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addIndex(
                [
                    'degree',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('activity_filter_date_types')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => false,
            ])
            ->addIndex(
                [
                    'type',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('activity_filter_education')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('education_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['user_id', 'education_id'])
            ->addIndex(
                [
                    'education_id',
                ]
            )
            ->create();

        $this->table('following_tags')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('tag_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['user_id', 'tag_id'])
            ->addIndex(
                [
                    'tag_id',
                ]
            )
            ->create();

        $this->table('languages')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('language', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addIndex(
                [
                    'language',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('location_selection_histories')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['user_id', 'location_id'])
            ->addColumn('selected_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->addIndex(
                [
                    'selected_at',
                ]
            )
            ->create();

        $this->table('locations')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('latitude', 'float', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 7,
            ])
            ->addColumn('longitude', 'float', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 7,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('iso_country_code', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => true,
            ])
            ->addColumn('country', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('postal_code', 'string', [
                'default' => null,
                'limit' => 20,
                'null' => true,
            ])
            ->addColumn('administrative_area', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('sub_administrative_area', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('locality', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('sub_locality', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('thoroughfare', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('sub_thoroughfare', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => true,
            ])
            ->addColumn('time_zone', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => true,
            ])
            ->addIndex(
                [
                    'latitude',
                    'longitude',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('media')
            ->addColumn('owner_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('position', 'integer', [
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['owner_id', 'position'])
            ->addColumn('media_type', 'enum', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'values' => ['Photo', 'Video', 'LivePhoto'],
            ])
            ->addColumn('file_path', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('uploaded_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('caption', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->create();

        $this->table('personalities')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('type', 'char', [
                'default' => null,
                'limit' => 4,
                'null' => false,
            ])
            ->addIndex(
                [
                    'type',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('personality_compatibility')
            ->addColumn('personality_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('matching_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['personality_id', 'matching_id'])
            ->addColumn('compatibility_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'compatibility_id',
                ]
            )
            ->addIndex(
                [
                    'matching_id',
                ]
            )
            ->create();

        $this->table('personality_compatibility_lookup')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('compatibility', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('details', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->create();

        $this->table('search_histories')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('search_type_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('search_string', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addPrimaryKey(['user_id', 'search_type_id', 'search_string'])
            ->addColumn('searched_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(
                [
                    'search_type_id',
                ]
            )
            ->addIndex(
                [
                    'searched_at',
                ]
            )
            ->create();

        $this->table('search_types')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('type', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addIndex(
                [
                    'type',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('tags')
            ->addColumn('tag_id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['tag_id'])
            ->addColumn('parent_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('tag', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('count', 'integer', [
                'default' => '0',
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'tag',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'parent_id',
                ]
            )
            ->create();

        $this->table('time_zones')
            ->addColumn('latitude', 'float', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 7,
            ])
            ->addColumn('longitude', 'float', [
                'default' => null,
                'null' => false,
                'precision' => 10,
                'scale' => 7,
            ])
            ->addPrimaryKey(['latitude', 'longitude'])
            ->addColumn('timezone', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->create();

        $this->table('transportation')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('mode', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addIndex(
                [
                    'mode',
                ],
                ['unique' => true]
            )
            ->create();

        $this->table('user_devices')
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('device_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['user_id', 'device_id'])
            ->addIndex(
                [
                    'device_id',
                ]
            )
            ->create();

        $this->table('user_logins')
            ->addColumn('account_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['account_id'])
            ->addColumn('device_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('logged_in_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('latitude', 'float', [
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 7,
            ])
            ->addColumn('longitude', 'float', [
                'default' => null,
                'null' => true,
                'precision' => 10,
                'scale' => 7,
            ])
            ->addIndex(
                [
                    'device_id',
                ]
            )
            ->create();

        $this->table('users')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('given_name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('family_name', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('birthdate', 'date', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('gender', 'enum', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'values' => ['Male', 'Female', 'Other'],
            ])
            ->addColumn('sexual_orientation', 'enum', [
                'default' => 'Straight',
                'limit' => null,
                'null' => false,
                'values' => ['Straight', 'Gay', 'Bisexual'],
            ])
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('profile_image_path', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addColumn('personality_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('education_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('bio', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('rating', 'integer', [
                'comment' => 'On a scale of 1 - 10',
                'default' => '5',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('verified', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'education_id',
                ]
            )
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->addIndex(
                [
                    'personality_id',
                ]
            )
            ->addIndex(
                [
                    'profile_image_path',
                ]
            )
            ->addIndex(
                [
                    'birthdate',
                    'gender',
                    'verified',
                ]
            )
            ->create();

        $this->table('activities')
            ->addForeignKey(
                'location_id',
                'locations',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'organizer_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'status_id',
                'activity_statuses',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('activities_tags')
            ->addForeignKey(
                'activity_id',
                'activities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'tag_id',
                'tags',
                'tag_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('activities_users')
            ->addForeignKey(
                'activity_id',
                'activities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('activity_applications')
            ->addForeignKey(
                'activity_id',
                'activities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'applicant_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('activity_filters')
            ->addForeignKey(
                'date_type_id',
                'activity_filter_date_types',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'location_id',
                'locations',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'SET_NULL'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('activity_itineraries')
            ->addForeignKey(
                'activity_id',
                'activities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'location_id',
                'locations',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'transportation_mode_id',
                'transportation',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('activity_reviews')
            ->addForeignKey(
                'activity_id',
                'activities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'reviewer_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('blocked_users')
            ->addForeignKey(
                'blocked_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'blocker_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('activity_filter_education')
            ->addForeignKey(
                'education_id',
                'education',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('following_tags')
            ->addForeignKey(
                'tag_id',
                'tags',
                'tag_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('location_selection_histories')
            ->addForeignKey(
                'location_id',
                'locations',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('media')
            ->addForeignKey(
                'owner_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('personality_compatibility')
            ->addForeignKey(
                'compatibility_id',
                'personality_compatibility_lookup',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'matching_id',
                'personalities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'personality_id',
                'personalities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('search_histories')
            ->addForeignKey(
                'search_type_id',
                'search_types',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('tags')
            ->addForeignKey(
                'parent_id',
                'tags',
                'tag_id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('user_devices')
            ->addForeignKey(
                'device_id',
                'devices',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'user_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('user_logins')
            ->addForeignKey(
                'device_id',
                'devices',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('users')
            ->addForeignKey(
                'education_id',
                'education',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'SET_NULL'
                ]
            )
            ->addForeignKey(
                'id',
                'accounts',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->addForeignKey(
                'location_id',
                'locations',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'personality_id',
                'personalities',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'SET_NULL'
                ]
            )
            ->update();

        // create triggers
        $this->execute("
        CREATE TRIGGER email_phone_number_not_both_null
          BEFORE INSERT
          ON accounts
          FOR EACH ROW
          BEGIN
            IF (NEW.email IS NULL AND NEW.phone_number IS NULL)
            THEN
              SIGNAL SQLSTATE '45000'
              SET MESSAGE_TEXT = 'email_address and phone_number cannot both be null';
            END IF;
          END;"
        );

        $this->execute("
        CREATE TRIGGER increase_tag_count
          AFTER INSERT
          ON activities_tags
          FOR EACH ROW
          BEGIN
            DECLARE current_tag_id INT UNSIGNED DEFAULT NEW.tag_id;

            WHILE (current_tag_id IS NOT NULL) DO
              UPDATE tag SET count = count + 1 WHERE tag_id = current_tag_id;
              SELECT parent_id INTO current_tag_id FROM tag WHERE tag.tag_id = current_tag_id;
            END WHILE;

            UPDATE tag SET count = count + 1 WHERE tag_id = current_tag_id;
          END;
        ");

        $this->execute("
        CREATE TRIGGER decrease_tag_count
          AFTER DELETE
          ON activities_tags
          FOR EACH ROW
          BEGIN
            DECLARE current_tag_id INT UNSIGNED DEFAULT OLD.tag_id;

            WHILE (current_tag_id IS NOT NULL) DO
              UPDATE tag SET count = count - 1 WHERE tag_id = current_tag_id;
              SELECT parent_id INTO current_tag_id FROM tag WHERE tag.tag_id = current_tag_id;
            END WHILE;

            UPDATE tag SET count = count - 1 WHERE tag_id = current_tag_id;
          END;
        ");

        $this->execute("
        CREATE TRIGGER create_filter
          AFTER INSERT
          ON users
          FOR EACH ROW
          BEGIN
            DECLARE age TINYINT;
            SET age = YEAR(UTC_DATE()) - YEAR(NEW.birthdate);
            INSERT INTO activity_filter (user_id, from_age, to_age) VALUE (NEW.id, GREATEST(18, age - 8), age + 8);
          END;
        ");
    }

    public function down()
    {
        $this->table('activities')
            ->dropForeignKey(
                'location_id'
            )
            ->dropForeignKey(
                'organizer_id'
            )
            ->dropForeignKey(
                'status_id'
            )->save();

        $this->table('activities_tags')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'tag_id'
            )->save();

        $this->table('activities_users')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('activity_applications')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'applicant_id'
            )->save();

        $this->table('activity_filters')
            ->dropForeignKey(
                'date_type_id'
            )
            ->dropForeignKey(
                'location_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('activity_itineraries')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'location_id'
            )
            ->dropForeignKey(
                'transportation_mode_id'
            )->save();

        $this->table('activity_reviews')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'reviewer_id'
            )->save();

        $this->table('blocked_users')
            ->dropForeignKey(
                'blocked_id'
            )
            ->dropForeignKey(
                'blocker_id'
            )->save();

        $this->table('activity_filter_education')
            ->dropForeignKey(
                'education_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('following_tags')
            ->dropForeignKey(
                'tag_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('location_selection_histories')
            ->dropForeignKey(
                'location_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('media')
            ->dropForeignKey(
                'owner_id'
            )->save();

        $this->table('personality_compatibility')
            ->dropForeignKey(
                'compatibility_id'
            )
            ->dropForeignKey(
                'matching_id'
            )
            ->dropForeignKey(
                'personality_id'
            )->save();

        $this->table('search_histories')
            ->dropForeignKey(
                'search_type_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('tags')
            ->dropForeignKey(
                'parent_id'
            )->save();

        $this->table('user_devices')
            ->dropForeignKey(
                'device_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('user_logins')
            ->dropForeignKey(
                'device_id'
            )->save();

        $this->table('users')
            ->dropForeignKey(
                'education_id'
            )
            ->dropForeignKey(
                'id'
            )
            ->dropForeignKey(
                'location_id'
            )
            ->dropForeignKey(
                'personality_id'
            )->save();

        $this->table('accounts')->drop()->save();
        $this->table('activities')->drop()->save();
        $this->table('activities_tags')->drop()->save();
        $this->table('activities_users')->drop()->save();
        $this->table('activity_applications')->drop()->save();
        $this->table('activity_filters')->drop()->save();
        $this->table('activity_itineraries')->drop()->save();
        $this->table('activity_reviews')->drop()->save();
        $this->table('activity_statuses')->drop()->save();
        $this->table('blocked_users')->drop()->save();
        $this->table('devices')->drop()->save();
        $this->table('education')->drop()->save();
        $this->table('activity_filter_date_types')->drop()->save();
        $this->table('activity_filter_education')->drop()->save();
        $this->table('following_tags')->drop()->save();
        $this->table('languages')->drop()->save();
        $this->table('location_selection_histories')->drop()->save();
        $this->table('locations')->drop()->save();
        $this->table('media')->drop()->save();
        $this->table('personalities')->drop()->save();
        $this->table('personality_compatibility')->drop()->save();
        $this->table('personality_compatibility_lookup')->drop()->save();
        $this->table('search_histories')->drop()->save();
        $this->table('search_types')->drop()->save();
        $this->table('tags')->drop()->save();
        $this->table('time_zones')->drop()->save();
        $this->table('transportation')->drop()->save();
        $this->table('user_devices')->drop()->save();
        $this->table('user_logins')->drop()->save();
        $this->table('users')->drop()->save();
    }
}