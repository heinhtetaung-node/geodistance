<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\MapService;
use App\Repositories\OrderRepository;
use App\Http\Requests\OrderGetRequest;
use App\Http\Requests\OrderSaveRequest;
use App\Http\Requests\OrderTakeRequest;

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
    public function index(OrderGetRequest $request){
    	$arr = $request->all();
        $res = $this->orderrepo->getAll($arr);
        return $res->items(); 
    }

    /**
	 * Api for orders save /orders
	 * @param order data
	 * @return orders array
	 */
    public function save(OrderSaveRequest $request){
        $arr = $request->all();
        $data = $this->mapService->getDistanceBetweenTwoCoordinates($arr['origin'], $arr['destination']);
        if(!isset($data->distances)){
            return response($data)->setStatusCode(422);
        }   
        $distance = $data->distances[0][1];
        $arr['distance'] = round($distance);
        $res = $this->orderrepo->createOrder($arr);
        return ['id' => $res->id, 'distance' => $res->distance, 'status' => $res->status];
    }

    /**
	 * Api for orders get /orders/{id}
	 * @param id and update status
	 * @return success response
	 */
    public function update($id, OrderTakeRequest $request){
    	$arr = $request->all();
        $res = $this->orderrepo->updateOrder($arr, $id);
        if($res==true){
            return ['status' => 'SUCCESS'];    
        }
        if($res=="TAKEN"){
            return response(['error' => 'Order is already taken'])->setStatusCode(422);
        }
        return response(['error' => 'Someting wrong in data processing'])->setStatusCode(422);
    }    
}
