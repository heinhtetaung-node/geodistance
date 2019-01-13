<?php

namespace App\Repositories;

use App\Models\Orders;

class OrderRepository
{

	private $model;
	
	public function __construct(Orders $order){
		$this->model = $order;
	}

	/**
	 * get all order
	 * @param limit, offset
	 */
	public function getAll($arr){
		return $this->model->select('id','distance','status')->orderBy('id', 'desc')->paginate($arr['limit']);
	}

	/**
	 * function for creating order
	 * @param order array
	 * @return order object
	 */
	public function createOrder($arr){
		$start_coordinates = implode(",", $arr['origin']);
		$end_coordinates = implode(",", $arr['origin']);
		$distance = $arr['distance'];
		$arr = $this->model->create([
			'start_coordinates' => $start_coordinates,
			'end_coordinates' => $end_coordinates,
			'distance' => $distance,
			'status' => 'UNASSIGNED'
		]);
		return $arr;
	}

	/**
	 *
	 */
	public function updateOrder($arr, $id){
		$order = $this->model->findOrFail($id);
		if($order->status == 'TAKEN'){
			return "TAKEN";
		}
		$order = $order->update(['status' => 'TAKEN']);
		return $order;
	}
}
