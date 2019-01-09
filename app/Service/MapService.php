<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Config;

class MapService
{
	private $mapboxtoken;
	private $mapbox;

	public function __construct(){
		$mapbox_url = Config::get('mapbox_service.url');
		$this->mapbox = new Client(['base_uri' => $mapbox_url]);
		$this->mapboxtoken = Config::get('mapbox_service.access_token');		
	}

	/**
	 * Function to get distance between two coordinates
	 * @param $originlatlon = array["startlat", "startlon"]
	 * @param $destinationlatlon = array["endlat", "endlon"]
	 * @param $profile = 'driving' or 'walking' or cycling
	 * @return distance in meter
	 */
	public function getDistanceBetweenTwoCoordinates($originlatlon, $destinationlatlon, $profile = 'driving'){
		$endpoint = Config::get('mapbox_service.endPoint.matrix');
		$version = Config::get('mapbox_service.version.1');
		$scope = Config::get('mapbox_service.scope.mapbox');
		$coordinates = $originlatlon[1].",".$originlatlon[0].";".$destinationlatlon[1].",".$destinationlatlon[0];

		$apilink = $endpoint."/".$version."/".$scope."/".$profile."/".$coordinates."?access_token=".$this->mapboxtoken."&annotations=distance";

		try {
		    $res = $this->mapbox->get($apilink);		    
		    $res = json_decode($res->getBody()->getContents());		
		} catch (RequestException $e) {
			$status_code = $e->getResponse()->getStatusCode();
			if($status_code == 422){
				return ['error' => 'please provide correct latitude and longitude'];
			}
			return ['error' => 'something error'];
        }		
        return $res;		
	}
}