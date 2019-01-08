<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
	 * Api for orders get /orders
	 * @param page, limit
	 * @return orders array
	 */
    public function index(Request $request){
    	// call api to this https://developer.here.com/documentation/routing/topics/resource-calculate-matrix.html
    	return $request->all();
    }

    /**
	 * Api for orders save /orders
	 * @param order data
	 * @return orders array
	 */
    public function save(Request $request){
    	return $request->all();
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
