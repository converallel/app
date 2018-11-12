<?php

namespace App\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Locations Controller
 *
 * @property \App\Model\Table\LocationsTable $Locations
 *
 * @method \App\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LocationsController extends AppController
{
    public function lookup()
    {
        $params = $this->getRequest()->getQueryParams();
        $latitude = $params['latitude'];
        $longitude = $params['longitude'];

        $distance = 0.31; // mile(s) ≈ 0.5km
        $lat_deviation = rad2deg($distance / 3959);
        $lng_deviation = rad2deg(asin($distance / 3959) / cos(deg2rad($latitude)));

        $location = $this->Locations->find()
            ->where([
                'latitude' => $latitude,
                'longitude' => $longitude
            ])
//            ->order($this->greatCircleDistance($latitude, $longitude, ))
            ->first();

        if (is_null($location))
            throw new RecordNotFoundException("Record not found in table {$this->getName()}");

        $this->setSerialized($location);
    }
}
