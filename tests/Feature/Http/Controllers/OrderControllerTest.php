<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Validar que el total sea reuqerido
     *
     * @return void
     */
    public function test_validate_total()
    {
        $response = $this->post('/api/orders/create',[

        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "total" => []
                ]
        ]);

    }

    /**
     * Validar que el tax sea reuqerido
     *
     * @return void
     */
    public function test_validate_tax()
    {
        $response = $this->post('/api/orders/create',[
            'total' => 12
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "tax" => []
                ]
        ]);

    }

    /**
     * Validar que el valor de envío sea reuqerido
     *
     * @return void
     */
    public function test_validate_shipping_value()
    {
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "shipping_value" => []
                ]
        ]);

    }

    /**
     * Validar que la fecha de entrega sea reuqerido
     *
     * @return void
     */
    public function test_validate_delivery_date()
    {
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000
        ]);

        $response->assertStatus(422);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "delivery_date" => []
                ]
        ]);

    }

     /**
     * Validar que la fecha de entrega sea una fecha
     *
     * @return void
     */
    public function test_validate_delivery_date_type_date()
    {
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->toDateString()
        ]);
        // dump($response->getData(true));
        $response->assertStatus(422);
    }

    /**
     * Validar que el cliente (user_id) exista
     *
     * @return void
     */
    public function test_validate_exists_user_id()
    {
        User::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 10
        ]);

        $response->assertStatus(422);
    }

    
    

    /**
     * Validar que venga detalle de la compra
     *
     * @return void
     */
    public function test_validate_exists_detail_purchase()
    {
        User::factory()->create();
        Status::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 1,
            'status_id' => 1,
        ]);


        $response->assertStatus(422);
    }

    /**
     * Validar que exista precio en el detalle
     *
     * @return void
     */
    public function test_validate_exists_price_detail()
    {
        User::factory()->create();
        Status::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 1,
            'status_id' => 1,
            'details' => [
                [
                    'price_with_discount' => 1
                ]
            ]
        ]);

        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "details.0.price" => []
            ]
        ]);

        

        $response->assertStatus(422);
    }

    /**
     * Validar que exista precio con descuento en el detalle
     *
     * @return void
     */
    public function test_validate_exists_price_with_discount_detail()
    {
        User::factory()->create();
        Status::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 1,
            'status_id' => 1,
            'details' => [
                [
                    'price' => 2
                ]
            ]
        ]);

        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "details.0.price_with_discount" => []
            ]
        ]);

        $response->assertStatus(422);
    }

    /**
     * Validar que se envíe un producto y que exista
     *
     * @return void
     */
    public function test_validate_exists_product()
    {
        User::factory()->create();
        Status::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 1,
            'status_id' => 1,
            'details' => [
               [
                    'price' => 2,
                    'price_with_discount' => 2
                ]
            ]
        ]);

        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "details.0.product_id" => []
            ]
        ]);
        $response->assertStatus(422);
    }

     /**
     * Validar que se envíe una catidad y que sea mayor o igual a uno
     *
     * @return void
     */
    public function test_validate_exists_quantity()
    {
        User::factory()->create();
        Status::factory(10)->create();
        Product::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 1,
            'status_id' => 1,
            'details' => [
                [
                    'price' => 2,
                    'price_with_discount' => 2,
                    'product_id' => 1
                ],
                
            ]
        ]);

        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "details.0.quantity" => []
            ]
        ]);

        $response->assertStatus(422);
    }


    /**
     * Validar que se pueda crear la orden
     *
     * @return void
     */
    public function test_successful_purchase()
    {
        User::factory()->create();
        Status::factory(10)->create();
        Product::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 1,
            'status_id' => 1,
            'details' => [
                [
                    'price' => 2,
                    'price_with_discount' => 2,
                    'product_id' => 1,
                    'quantity' => 1,
                    'tax' => 1
                ],
                [
                    'price' => 2,
                    'price_with_discount' => 2,
                    'product_id' => 1,
                    'quantity' => 1,
                    'tax' => 1
                ]
            ]
        ]);

        // dump($response->getData(true));
        $response->assertStatus(200);
    }
}
