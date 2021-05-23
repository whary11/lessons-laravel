<?php

namespace Tests\Feature\Http\Controllers;

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
     * Validar que el estado exista
     *
     * @return void
     */
    public function test_validate_exists_status_id()
    {
        User::factory()->create();
        $response = $this->post('/api/orders/create',[
            'total' => 12,
            'tax' => 12,
            'shipping_value' => 5000,
            'delivery_date' => Carbon::now()->addHour()->toDateTimeString(),
            'user_id' => 1,
            'status_id' => 2
        ]);

        $response->assertStatus(422);
    }
}
