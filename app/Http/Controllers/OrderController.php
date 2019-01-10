<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MapService;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    private $mapService;
    private $orderrepo;

    /**
     * OrderController constructor.
     */
    public function __construct(MapService $mapService, OrderRepository $orderrepo)
    {
        $this->mapService = $mapService;
        $this->orderrepo = $orderrepo;
    }

    /**
	 * Api for orders get /orders
	 * @param page, limit
	 * @return orders array
	 */
    public function index(Request $request){
    	$arr = $request->all();
        return $this->orderrepo->getAll($arr);
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
        $distance = $data->distances[0][1];
        $arr['distance'] = $distance;
        $res = $this->orderrepo->createOrder($arr);
        return $res;
    }

    /**
	 * Api for orders get /orders/{id}
	 * @param id and update status
	 * @return success response
	 */
    public function update($id, Request $request){
    	$arr = $request->all();
        $res = $this->orderrepo->updateOrder($arr, $id);
        return $res;
    }    
}
