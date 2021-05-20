<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
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
            'delivery_date' => '2021-05-20'
        ]);
        $response->assertStatus(200);
    }
}
