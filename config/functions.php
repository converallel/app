<?php

/**
 * This routine calculates the distance between two points (given the latitude/longitude of those points).
 * South latitudes are negative, east longitudes are positive
 *
 * @param float $lat1 Latitude of point 1 (in decimal degrees)
 * @param float $lng1 Longitude of point 1 (in decimal degrees)
 * @param float $lat2 Latitude of point 2 (in decimal degrees)
 * @param float $lng2 Longitude of point 2 (in decimal degrees)
 * @param string $unit 'M' - statute miles, 'K' - kilometers, 'N' - nautical miles
 * @return float
 */
function greatCircleDistance($lat1, $lng1, $lat2, $lng2, $unit = 'M')
{
    $theta = $lng1 - $lng2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == 'K') {
        return ($miles * 1.609344);
    } else if ($unit == 'N') {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

function startsWith($haystack, $needle)
{
    return substr($haystack, 0, strlen($needle)) === $needle;
}