<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Orders;

class OrderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testPlaceOrder()
    {
        $washington_latitude = "38.896281";
        $washington_longitude = "-77.021328";
        $newyork_latitude = "40.731159";
        $newyork_longitude = "-74.015994";
        $data = [
		    "origin" => [$washington_latitude, $washington_longitude],
		    "destination" => [$newyork_latitude, $newyork_longitude]
		];

        // Distance between Washington and Newyork according to google map 227miles
        $distanceBewtwenWashingtonNewyork = 365345; // 227 mile to metre 365345

        $returndata = $this->post(route('order.save'), $data);
        $returndata->assertStatus(200);
        $returndata->assertJsonStructure(['id', 'distance', 'status']);

        // check return distance is equal with expected
        $this->assertEquals($distanceBewtwenWashingtonNewyork, $returndata->original['distance']);
    }

    public function testPlaceOrderWrongParameterValidation()
    {
        $data = [
            "origin1" => '',
            "destination1" => ''
        ];
        $returndata = $this->post(route('order.save'), $data);
        $returndata->assertStatus(422);
        $returndata->assertJsonStructure(['error', 'error_detail']);
        $error = $returndata->original['error'];
        $this->assertEquals($error, "VALIDATION_ERRORS");   
    }

    public function testPlaceOrderWrongInputValueValidation()
    {
        $data = [
            "origin" => 'adfd',
            "destination" => 'dfdf'
        ];
        $returndata = $this->post(route('order.save'), $data);
        $returndata->assertStatus(422);
        $returndata->assertJsonStructure(['error', 'error_detail']);
        $error = $returndata->original['error'];
        $this->assertEquals($error, "VALIDATION_ERRORS");
    }

    public function testTakeOrder()
    {
        $order = factory(Orders::class)->create();
        $data = [
            'status' => 'TAKEN'
        ];
        $returndata = $this->patch(route('order.update', $order->id), $data);
        $returndata->assertStatus(200);
        $returndata->assertJson(['status' => 'SUCCESS']);
        $updatedOrder = Orders::findOrFail($order->id);
        $this->assertEquals($updatedOrder->status, "TAKEN");
    }

    public function testTakeOrderWrongParameterValidation()
    {
        $order = factory(Orders::class)->create();
        $data = [
            'status123' => 'TAKEN'
        ];
        $returndata = $this->patch(route('order.update', $order->id), $data);
        $returndata->assertStatus(422);
        $returndata->assertJsonStructure(['error', 'error_detail']);
        $error = $returndata->original['error'];
        $this->assertEquals($error, "VALIDATION_ERRORS");
    }

    public function testTakeOrderWrongInputValueValidation()
    {
        $order = factory(Orders::class)->create();
        $data = [
            'status' => 'TAKEN1'
        ];
        $returndata = $this->patch(route('order.update', $order->id), $data);
        $returndata->assertStatus(422);
        $returndata->assertJsonStructure(['error', 'error_detail']);
        $error = $returndata->original['error'];
        $this->assertEquals($error, "VALIDATION_ERRORS");
    }
    
    public function testOrderList()
    {
        $orders = factory(Orders::class, 10)->create()->map(function ($order) {
            return $order->only(['id', 'distance', 'status']);
        });
        $returndata = $this->get(route('order.all', ['page'=>1, 'limit'=>2]));
        // test only return the last two array        
        $returndata->assertJson([ $orders[9], $orders[8] ]);

        $returndata = $this->get(route('order.all', ['page'=>2, 'limit'=>2]));
        // test only return two array from page 2      
        $returndata->assertJson([ $orders[7], $orders[6] ]);
    }

    public function testOrderListWrongParameterValidation()
    {
        $returndata = $this->get(route('order.all', ['page1'=>1, 'limit1'=>2]));
        $returndata->assertStatus(422);
        $returndata->assertJsonStructure(['error', 'error_detail']);   
        $error = $returndata->original['error'];
        $this->assertEquals($error, "VALIDATION_ERRORS");
    }

    public function testOrderListWrongInputValueValidation()
    {
        $returndata = $this->get(route('order.all', ['page'=>'a', 'limit'=>'b']));
        $returndata->assertStatus(422);
        $returndata->assertJsonStructure(['error', 'error_detail']);   
        $error = $returndata->original['error'];
        $this->assertEquals($error, "VALIDATION_ERRORS");
    }
}
