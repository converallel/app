<?php

use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Initial extends AbstractMigration
{

    public $autoId = false;

    public function up()
    {

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
            ->addColumn('admin_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('is_pair', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('exclusive', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('location_visibility', 'enum', [
                'default' => 'Vicinity',
                'limit' => null,
                'null' => false,
                'values' => ['Full Address', 'Hidden', 'Vicinity'],
            ])
            ->addColumn('details', 'string', [
                'default' => null,
                'limit' => 300,
                'null' => true,
            ])
            ->addColumn('status', 'enum', [
                'default' => 'Active',
                'limit' => null,
                'null' => false,
                'values' => ['Active', 'Cancelled', 'Completed'],
            ])
            ->addColumn('group_size_limit', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('application_count', 'integer', [
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('organizer_count', 'integer', [
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('participant_count', 'integer', [
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('review_count', 'integer', [
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
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('deleted_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->addIndex(
                [
                    'admin_id',
                ]
            )
            ->addIndex(
                [
                    'start_date',
                    'is_pair',
                    'status',
                ]
            )
            ->create();

        $this->table('activities_media')
            ->addColumn('activity_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('media_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['activity_id', 'media_id'])
            ->addIndex(
                [
                    'media_id',
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
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
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
            ->addColumn('type', 'enum', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'values' => ['Following', 'Organizing', 'Participating']
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'activity_id',
                    'user_id',
                    'type',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'user_id',
                ]
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

        $this->table('activity_filters')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('using_current_location', 'boolean', [
                'default' => true,
                'limit' => null,
                'null' => false,
                'signed' => false,
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
                'signed' => false,
            ])
            ->addColumn('verified_user', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'user_id',
                ],
                ['unique' => true]
            )
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
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
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
            ->addColumn('location_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('arrive_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('depart_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('transportation_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => true,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'activity_id',
                    'stop',
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'location_id',
                ]
            )
            ->addIndex(
                [
                    'transportation_id',
                ]
            )
            ->create();

        $this->table('applications')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
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
            ->addColumn('deleted_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'activity_id',
                    'user_id'
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->addIndex(
                [
                    'status',
                ]
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

        $this->table('contacts')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('type', 'enum', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'values' => ['Email', 'Phone']
            ])
            ->addColumn('contact', 'string', [
                'default' => null,
                'limit' => 60,
                'null' => false,
            ])
            ->addIndex(
                [
                    'contact',
                ],
                ['unique' => true]
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
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
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
            ->addColumn('deleted_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
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

        $this->table('files')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('server', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('directory', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('extension', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('size', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('deleted_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->create();

        $this->table('http_status_codes')
            ->addColumn('code', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['code'])
            ->addColumn('definition', 'string', [
                'default' => null,
                'limit' => 40,
                'null' => false,
            ])
            ->create();

        $this->table('location_selection_histories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
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
            ->addColumn('selected_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
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

        $this->table('logs')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('ip_address', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('request_method', 'enum', [
                'default' => null,
                'limit' => 10,
                'null' => false,
                'values' => ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH']
            ])
            ->addColumn('request_url', 'string', [
                'default' => null,
                'limit' => 45,
                'null' => false,
            ])
            ->addColumn('request_headers', 'json', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('request_body', 'json', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('status_code', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
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
                    'user_id',
                ]
            )
            ->addIndex(
                [
                    'status_code',
                ]
            )
            ->create();

        $this->table('media')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('file_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('type', 'enum', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'values' => ['Image', 'Video']
            ])
            ->addColumn('position', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('caption', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => true,
            ])
            ->addIndex(
                [
                    'file_id',
                ]
            )
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
            ->addColumn('level_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'level_id',
                ]
            )
            ->addIndex(
                [
                    'matching_id',
                ]
            )
            ->create();

        $this->table('personality_compatibility_levels')
            ->addColumn('id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 30,
                'null' => false,
            ])
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->create();

        $this->table('reviews')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
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
            ->addColumn('rating', 'integer', [
                'comment' => 'On a scale of 1 - 5',
                'default' => null,
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('message', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
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
            ->addColumn('deleted_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('helpful', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('not_helpful', 'integer', [
                'default' => 0,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addIndex(
                [
                    'activity_id',
                    'user_id'
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->addIndex(
                [
                    'helpful',
                    'created_at',
                ]
            )
            ->create();

        $this->table('search_histories')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addColumn('search_type', 'enum', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'values' => ['Activity', 'Event', 'Location', 'User']
            ])
            ->addColumn('search_string', 'string', [
                'default' => null,
                'limit' => 100,
                'null' => false,
            ])
            ->addColumn('searched_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(
                [
                    'user_id',
                ]
            )
            ->addIndex(
                [
                    'searched_at',
                ]
            )
            ->create();

        $this->table('tags')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
            ->addColumn('parent_id', 'integer', [
                'default' => null,
                'limit' => MysqlAdapter::INT_SMALL,
                'null' => true,
                'signed' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 30,
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
                    'name',
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
            ->addColumn('identifier', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addIndex(
                [
                    'latitude',
                    'longitude',
                ],
                ['unique' => true]
            )
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

        $this->table('user_logins')
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'default' => null,
                'limit' => 11,
                'null' => false,
                'signed' => false,
            ])
            ->addPrimaryKey(['id'])
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
                    'user_id',
                    'device_id',
                    'logged_in_at'
                ],
                ['unique' => true]
            )
            ->addIndex(
                [
                    'device_id',
                ]
            )
            ->create();

        $this->table('users_tags')
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

        $this->table('users')
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
            ->addColumn('password', 'char', [
                'default' => null,
                'limit' => 60,
                'null' => false,
            ])
            ->addColumn('failed_login_attempts', 'integer', [
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'null' => false,
                'signed' => false,
            ])
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
                'signed' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('deleted_at', 'timestamp', [
                'default' => null,
                'limit' => null,
                'null' => true,
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
                'admin_id',
                'users',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('activities_media')
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
                'media_id',
                'media',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
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
                'id',
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
                'transportation_id',
                'transportation',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('applications')
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

        $this->table('contacts')
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

        $this->table('devices')
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

        $this->table('files')
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

        $this->table('logs')
            ->addForeignKey(
                'status_code',
                'http_status_codes',
                'code',
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

        $this->table('media')
            ->addForeignKey(
                'file_id',
                'files',
                'id',
                [
                    'update' => 'CASCADE',
                    'delete' => 'CASCADE'
                ]
            )
            ->update();

        $this->table('personality_compatibility')
            ->addForeignKey(
                'level_id',
                'personality_compatibility_levels',
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

        $this->table('reviews')
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

        $this->table('search_histories')
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

        $this->table('users_tags')
            ->addForeignKey(
                'tag_id',
                'tags',
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
          ON users
          FOR EACH ROW
          BEGIN
            IF (NEW.email IS NULL AND NEW.phone_number IS NULL)
            THEN
              SIGNAL SQLSTATE '45000'
              SET MESSAGE_TEXT = 'email and phone number cannot both be empty';
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
              UPDATE tags SET count = count + 1 WHERE id = current_tag_id;
              SELECT parent_id INTO current_tag_id FROM tags WHERE tags.id = current_tag_id;
            END WHILE;

            UPDATE tags SET count = count + 1 WHERE id = current_tag_id;
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
              UPDATE tags SET count = count - 1 WHERE id = current_tag_id;
              SELECT parent_id INTO current_tag_id FROM tags WHERE tags.id = current_tag_id;
            END WHILE;

            UPDATE tags SET count = count - 1 WHERE id = current_tag_id;
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
            INSERT INTO activity_filters (user_id, from_age, to_age) VALUE (NEW.id, GREATEST(18, age - 8), age + 8);
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
                'admin_id'
            )
            ->save();

        $this->table('activities_media')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'media_id'
            )->save();

        $this->table('activities_users')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('activities_tags')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'tag_id'
            )->save();

        $this->table('activity_filter_education')
            ->dropForeignKey(
                'education_id'
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
                'transportation_id'
            )->save();

        $this->table('applications')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('blocked_users')
            ->dropForeignKey(
                'blocked_id'
            )
            ->dropForeignKey(
                'blocker_id'
            )->save();

        $this->table('contacts')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('devices')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('files')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('logs')
            ->dropForeignKey(
                'status_code'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('media')
            ->dropForeignKey(
                'file_id'
            )
            ->save();

        $this->table('personality_compatibility')
            ->dropForeignKey(
                'level_id'
            )
            ->dropForeignKey(
                'matching_id'
            )
            ->dropForeignKey(
                'personality_id'
            )->save();

        $this->table('reviews')
            ->dropForeignKey(
                'activity_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('search_histories')
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('tags')
            ->dropForeignKey(
                'parent_id'
            )->save();

        $this->table('user_logins')
            ->dropForeignKey(
                'device_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();


        $this->table('users_tags')
            ->dropForeignKey(
                'tag_id'
            )
            ->dropForeignKey(
                'user_id'
            )->save();

        $this->table('users')
            ->dropForeignKey(
                'education_id'
            )
            ->dropForeignKey(
                'location_id'
            )
            ->dropForeignKey(
                'personality_id'
            )->save();

        $this->table('activities')->drop()->save();
        $this->table('activities_media')->drop()->save();
        $this->table('activities_tags')->drop()->save();
        $this->table('activities_users')->drop()->save();
        $this->table('activity_filter_date_types')->drop()->save();
        $this->table('activity_filter_education')->drop()->save();
        $this->table('activity_filters')->drop()->save();
        $this->table('activity_itineraries')->drop()->save();
        $this->table('applications')->drop()->save();
        $this->table('blocked_users')->drop()->save();
        $this->table('contacts')->drop()->save();
        $this->table('devices')->drop()->save();
        $this->table('education')->drop()->save();
        $this->table('files')->drop()->save();
        $this->table('http_status_codes')->drop()->save();
        $this->table('location_selection_histories')->drop()->save();
        $this->table('locations')->drop()->save();
        $this->table('logs')->drop()->save();
        $this->table('media')->drop()->save();
        $this->table('personalities')->drop()->save();
        $this->table('personality_compatibility')->drop()->save();
        $this->table('personality_compatibility_levels')->drop()->save();
        $this->table('search_histories')->drop()->save();
        $this->table('reviews')->drop()->save();
        $this->table('tags')->drop()->save();
        $this->table('time_zones')->drop()->save();
        $this->table('transportation')->drop()->save();
        $this->table('user_logins')->drop()->save();
        $this->table('users_tags')->drop()->save();
        $this->table('users')->drop()->save();
    }
}
