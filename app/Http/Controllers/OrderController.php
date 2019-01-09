<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MapService;

class OrderController extends Controller
{
    private $mapService;

    /**
     * OrderController constructor.
     */
    public function __construct(MapService $mapService)
    {
        $this->mapService = $mapService;
    }

    /**
	 * Api for orders get /orders
	 * @param page, limit
	 * @return orders array
	 */
    public function index(Request $request){
    	return $request->all();
    }

    /**
	 * Api for orders save /orders
	 * @param order data
	 * @return orders array
	 */
    public function save(Request $request){
        $arr = $request->all();
        $data = $this->mapService->getDistanceBetweenTwoCoordinates($arr['origin'], $arr['destination']);
        if(!isset($data->distances)){
            return response($data)->setStatusCode(422);
        }   
        return (array)$data;        
    }

    /**
	 * Api for orders get /orders/{id}
	 * @param id and update status
	 * @return success response
	 */
    public function update($id, Request $request){
    	return $request->all();
    }    
}
