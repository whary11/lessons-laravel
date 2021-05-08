<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    // CRUD
    /**
     * Validar nombre del producto.
     *
     * @return void
     */
    public function test_validate_name()
    {
        $response = $this->post('/api/product/create', [
            "name" => "123456789",
            "description" => '',
            "image" => '',
            "price" => '',
            "stock" => 1,
            "status_id" => 1
        ]);

        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "name"
            ]
        ]);
        $response->assertStatus(422);
    }

    /**
     * Validar descripción.
     *
     * @return void
     */
    public function test_validate_description()
    {
        $response = $this->post('/api/product/create', [
            "name" => "123456789",
            "description" => '',
            "image" => '',
            "price" => '',
            "stock" => 1,
            "status_id" => 1
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "description"
            ]
        ]);
        $response->assertStatus(422);
    }

    /**
     * Validar imagen.
     *
     * @return void
     */
    public function test_validate_image()
    {

        Storage::fake('products');
        $response = $this->post('/api/product/create', [
            "name" => "0123456789",
            "description" => "0123456789",
            "image" => '',// UploadedFile::fake('products')->image('p1.svg'),
            "price" => '',
            "stock" => 1,
            "status_id" => 1
        ]);



        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "image"
            ]
        ]);
        $response->assertStatus(422);
    }

     /**
     * Validar precio.
     *
     * @return void
     */
    public function test_validate_price()
    {
        Storage::fake('products');
        $response = $this->post('/api/product/create', [
            "name" => "0123456789",
            "description" => "0123456789",
            "image" => UploadedFile::fake('products')->image('p1.png'),
            "price" => '',
            "stock" => 1,
            "status_id" => 1
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "price"
            ]
        ]);
        $response->assertStatus(422);
    }


     /**
     * Validar stock.
     *
     * @return void
     */
    public function test_validate_stock()
    {
        Storage::fake('products');
        $response = $this->post('/api/product/create', [
            "name" => "0123456789",
            "description" => "0123456789",
            "image" => UploadedFile::fake('products')->image('p1.png'),
            "price" => 1,
            "stock" => '',
            "status_id" => 1
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "stock"
            ]
        ]);
        $response->assertStatus(422);
    }

     /**
     * Validar estado.
     *
     * @return void
     */
    public function test_validate_status()
    {

        Storage::fake('products');
        $response = $this->post('/api/product/create', [
            "name" => "0123456789",
            "description" => "0123456789",
            "image" => UploadedFile::fake('products')->image('p1.png'),
            "price" => 1,
            "stock" => 1,
            "status_id" => 1
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "status_id"
            ]
        ]);
        $response->assertStatus(422);
    }

     /**
     * Creación del producto.
     *
     * @return void
     */
    public function test_validate_create_product()
    {

        Status::factory()->create();
        Storage::fake('products');
        $response = $this->post('/api/product/create', [
            "name" => "Computador Mac",
            "description" => "Computador Mac de 1GB de RAM.",
            "image" => UploadedFile::fake('products')->image('p1.png'),
            "price" => 10000,
            "stock" => 10,
            "status_id" => 1
        ]);

        $response->getData(true);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "product"
            ]
        ]);
        $response->assertStatus(200);
    }


     /**
     * LIstar productos
     *
     * @return void
     */
    public function test_list_products()
    {

        Status::factory()->create();
        Storage::fake('products');
        // Product::factory()->create();


        $response = $this->get('/api/product/get');
        
        // dump($response->getData(true));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                '*' => [
                    "id",
                    "name",
                    "description",
                    "image_url",
                    "price",
                    "slug",
                    "stock",
                    "status_id",
                    "created_at",
                    "updated_at"
                ]
            ]
        ]);
    }




}
