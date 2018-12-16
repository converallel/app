<?php

namespace App\Controller;

use Cake\Http\Exception\BadRequestException;
use Cake\I18n\Time;

/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivityFiltersTable $ActivityFilters
 * @property \App\Model\Table\ActivitiesTable $Activities
 *
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitiesController extends AppController
{

    public function index()
    {
        $this->loadModel('ActivityFilters');
        $user_id = $this->current_user->id;

        $queryParams = $this->getRequest()->getQueryParams();
        $isPair = filter_var($queryParams['is_pair'] ?? true, FILTER_VALIDATE_BOOLEAN);
        $refresh = filter_var($queryParams['refresh'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $position = $queryParams['position'] ?? null; // id of the closest activity

        if ($refresh && !$position) {
            throw new BadRequestException();
        }

        // get viewer filter
        $activityFilter = $this->ActivityFilters->find()
            ->select([
                'latitude' => 'Locations.latitude',
                'longitude' => 'Locations.longitude',
                'time_zone' => 'Locations.time_zone'
            ])
            ->selectAllExcept($this->ActivityFilters, ['id', 'user_id'])
            ->contain(['Locations'])
            ->where(['ActivityFilters.id' => $user_id])->first();

        if (!$activityFilter['latitude'] || !$activityFilter['longitude']) {
            throw new BadRequestException('Unable to load activities because location is not set.');
        }

        $dateType = $activityFilter['date_type'];
        $startDateString = $activityFilter['start_date'];
        $endDateString = $activityFilter['end_date'];
        $viewerTimeZone = $activityFilter['time_zone'];
        $now = (new Time())->setTimezone($viewerTimeZone);

        // if customized dates are outdated, reset day type to all dates
        if ($dateType === 'Customized' && new Time($startDateString, $viewerTimeZone) <= $now) {
            $activityFilter->set('type', 'All');
            $activityFilter->set('start_date', null);
            $activityFilter->set('end_date', null);
            $this->ActivityFilters->save($activityFilter);
            $dateType = 'All';
        }

        $endOfToday = $now->copy()->endOfDay();
        $startOfTomorrow = $now->copy()->addDay()->startOfDay();
        $endOfTomorrow = $startOfTomorrow->copy()->endOfDay();
        $startOfWeekend = $now->copy()->startOfWeek()->addDays(5);
        $endOfWeek = $now->copy()->endOfWeek();
        $startOfNextWeek = $now->copy()->addWeek()->startOfWeek();
        $endOfNextWeek = $startOfNextWeek->copy()->endOfWeek();

        switch ($dateType) {
            case 'All':
                $startDate = $now;
                $endDate = null;
                break;
            case 'Today':
                $startDate = $now;
                $endDate = $endOfToday;
                break;
            case 'Tomorrow':
                $startDate = $startOfTomorrow;
                $endDate = $endOfTomorrow;
                break;
            case 'This Weekend':
                $startDate = $startOfWeekend;
                $endDate = $endOfWeek;
                break;
            case 'This Week':
                $startDate = $now;
                $endDate = $endOfWeek;
                break;
            case 'Next Week':
                $startDate = $startOfNextWeek;
                $endDate = $endOfNextWeek;
                break;
            case 'Customized':
                $startDate = new Time($startDateString, $viewerTimeZone);
                $endDate = new Time($endDateString, $viewerTimeZone);
                break;
            default:
                throw new \InvalidArgumentException("Unexpected date type: $dateType.");
        }

        // convert time back to UTC
        $startDate = $startDate->setTimezone('UTC');
        $endDate = is_null($endDate) ? null : $endDate->setTimezone('UTC');

        // find activities
        $query = $this->Activities
            ->find('basicInfo')
            ->where([
                'start_date >=' => $startDate,
                'is_pair' => $isPair,
                'Activities.status' => 'Active',
            ])
            ->order([
                'Activities.start_date' => 'ASC',
                'Activities.id' => 'DESC'
            ]);

        if ($endDate) {
            $query->where(['start_date <=' => $endDate]);
        }

        if ($position) {
            $positionActivityStartDate = $this->Activities->find()
                ->select('start_date')->where(['id' => $position]);
            $query->where([
                'OR' => [
                    'AND' => [
                        'Activities.start_date' => $positionActivityStartDate,
                        'Activities.id ' . ($refresh ? '>' : '<') => $position,
                    ],
                    'Activities.start_date ' . ($refresh ? '<' : '>') => $positionActivityStartDate
                ]
            ]);
        }

        // users
        $query->where([
            'Admin.birthdate >=' => $now->copy()->subYears($activityFilter['to_age']),
            'Admin.birthdate <=' => $now->copy()->subYears($activityFilter['from_age'])
        ]);

        if ($activityFilter['verified_users']) {
            $query->where(['Admin.verified' => true]);
        }

        $gender = explode(',', $activityFilter['gender']);
        $sexual_orientation = explode(',', $activityFilter['sexual_orientation']);
        if ($gender === ['']) {
            $gender = [];
        }
        if ($sexual_orientation === ['']) {
            $sexual_orientation = [];
        }

        if ($gender) {
            $query->whereInList('Admin.gender', $gender);
        }

        if ($sexual_orientation) {
            $query->whereInList('Admin.sexual_orientation', $sexual_orientation);
        }

        if (!$refresh) {
            $query->limit(10);
        }

        // location
        $distance = $activityFilter['distance'];
        $latitude = $activityFilter['latitude'];
        $longitude = $activityFilter['longitude'];
        $deltaLatitudeDegrees = rad2deg($distance / 3959);
        $deltaLongitudeDegrees = rad2deg(asin($distance / 3959) / cos(deg2rad($latitude)));
        $query->where([
            'latitude >=' => $latitude - $deltaLatitudeDegrees,
            'latitude <=' => $latitude + $deltaLatitudeDegrees,
            'longitude >=' => $longitude - $deltaLongitudeDegrees,
            'longitude <=' => $longitude + $deltaLongitudeDegrees,
            "great_circle_distance($latitude, $longitude, latitude, longitude, 'M') <= $distance"
        ]);

        $this->load($query);
    }

    public function view($id = null)
    {
        $this->get($id, ['finder' => 'details']);
    }

    public function add()
    {
        $this->create([
            ['objectHydration' => ['associated' => ['Tags' => ['onlyIds' => true]]]]
        ]);
    }
}
