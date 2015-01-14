<?php
/* Google API Instruments */
namespace common\components;
use Yii;
class GoogleApiHelper {
    // service wrapper 1
    // recive address string in native format
    // return altitude/longitude array ['lat', 'lon'] or NULL if address not exist/valid
    public static function getLatLon($address){
        $point = NULL;
        $addressString = str_replace(' ', '+', $address);
        $constPartUrl = 'https://maps.googleapis.com/maps/api/geocode/xml?key='.Yii::$app->params['GoogleAPI'];
        $url = $constPartUrl . '&address=' . $addressString;
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, 0);
        curl_setopt($handle, CURLOPT_TIMEOUT, 5);
        $container = curl_exec($handle);
        curl_close($handle);
        $object = @simplexml_load_string($container);
        if (isset($object->result->geometry)) {
            $point['lat'] = (float)$object->result->geometry->location->lat;
            $point['lon'] = (float)$object->result->geometry->location->lng;
        }
        return $point;
    }
    // service wrapper 2
    // recive address string and radius of distance bordered search space point
    // return search space as coordinate array of square: ['lat1', 'lat2', 'lon1', 'lon2']
    // this square can use in database-search for example: $query->andWhere(['between', 'lon', $lon1, $lon2]);$query->andWhere(['between', 'lat', $lat1, $lat2]);
    public static function getSearchSquare($address, $distance){
        $dest = GoogleApiHelper::getLatLon($address);
        if(!is_null($dest) && !is_null($distance)){
            $myLat = $dest['lat'];
            $myLon = $dest['lon'];
            $dist = (int)$distance;
            if($dist === 0){
                RETURN NULL; 
            }
            $lat1 = $myLat - ($dist / 69);
            $lat2 = $myLat + ($dist / 69);
            $lon1 = $myLon - $dist / abs(cos(deg2rad($myLat)) * 69);
            $lon2 = $myLon + $dist / abs(cos(deg2rad($myLat)) * 69);
            $square = compact($lat1, $lat2, $lon1, $lon2, ['lat1','lat2','lon1','lon2']);
            return $square;
        }
        return NULL;
    }
}






/*
 * 
 * $model->calculateLatLon($get['location']);
            $mylon = $model->lon;
            $mylat = $model->lat;
            $dist = (int)$get['distance'];

            $lon1 = $mylon - $dist / abs(cos(deg2rad($mylat)) * 69);
            $lon2 = $mylon + $dist / abs(cos(deg2rad($mylat)) * 69);
            $lat1 = $mylat - ($dist / 69);
            $lat2 = $mylat + ($dist / 69);

            $query->andWhere(['between', 'lon', $lon1, $lon2]);
            $query->andWhere(['between', 'lat', $lat1, $lat2]);

 *  */