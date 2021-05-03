<?php

namespace Tests\Feature\Http\Controllers\LoginController;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Validar email enviado por el usuario
     *
     * @return void
     */
    public function test_validate_email()
    {
        User::factory()->create([
                'password' => Hash::make('1234567'),
                'email' =>'luis.raga@admin.com'
            
        ]);
        $response = $this->post('api/authentication/login', [
            'password' => '1234567',
            'email' =>'luis.raga@admin.co'
        ]);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                  "email" => []
                ]
        ]);
        $response->assertStatus(422);
    }

    /**
     *  Validar password enviado por el usuario
     *
     * @return void
     */

    public function test_validate_password()
    {
        User::factory()->create([
                'password' => Hash::make('1234567'),
                'email' =>'luis.raga@admin.com'
            
        ]);
        $response = $this->post('api/authentication/login', [
            'email' =>'luis.raga@admin.com'
            // 'password' => '123456',
        ]);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                  "password" => []
                ]
        ]);
        $response->assertStatus(422);
    }


     /**
     *  Validar credenciales incorrectas
     *
     * @return void
     */

    public function test_wrong_credentials()
    {
        User::factory()->create([
                'password' => Hash::make('1234567'),
                'email' =>'luis.raga@admin.com'
            
        ]);
        $response = $this->post('api/authentication/login', [
            'email' =>'luis.raga@admin.com',
            'password' => '123456',
        ]);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                  "message",
                  "code"
                ]
        ]);
        $response->assertSee("Credenciales incorrectas");
        $response->assertStatus(200);
    }

    /**
     *  Validar credenciales incorrectas
     *
     * @return void
     */

    public function test_successful_login()
    {
        User::factory()->create([
                'password' => Hash::make('1234567'),
                'email' =>'luis.raga@admin.com'
            
        ]);
        $response = $this->post('api/authentication/login', [
            'email' =>'luis.raga@admin.com',
            'password' => '1234567',
        ]);

        $response->assertJsonStructure([
                "status",
                "message",
                "data" => [
                  "code",
                  "token"
                ]
        ]);
        $response->assertSee("success");
        $response->assertStatus(200);
    }
}
