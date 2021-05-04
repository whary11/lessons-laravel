<?php

namespace Tests\Feature\Http\Controllers\Authentication;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Validar email.
     *
     * @return void
     */
    public function test_validate_email()
    {
        $response = $this->post('/api/authentication/login', [
            'password' => '123456'
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "email"
            ]
        ]);
        $response->assertStatus(422);
    }

    /**
     * Validar contraseña.
     *
     * @return void
     */
    public function test_validate_password()
    {
        User::factory()->create([
            'email' => 'lui.raga@admin.com'
        ]);
        $response = $this->post('/api/authentication/login', [
            'email' => 'lui.raga@admin.com'
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "password"
            ]
        ]);
        $response->assertStatus(422);
    }


    /**
     * Credenciales incorrectas.
     *
     * @return void
     */
    public function test_wrong_credentials()
    {
        User::factory()->create([
            'email' => 'lui.raga@admin.com',
            'password' => Hash::make('lui.raga@admin.com')  
        ]);
        $response = $this->post('/api/authentication/login', [
            'email' => 'lui.raga@admin.com',
            'password' => 'hbasdkjhjfk'
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
     * Login exitoso.
     *
     * @return void
     */
    public function test_successful_login()
    {
        User::factory()->create([
            'email' => 'lui.raga@admin.com',
            'password' => Hash::make('lui.raga@admin.com')  
        ]);
        $response = $this->post('/api/authentication/login', [
            'email' => 'lui.raga@admin.com',
            'password' => 'lui.raga@admin.com'
        ]);
        $response->assertJsonStructure([
            "status",
            "message",
            "data" => [
                "token",
                "code"
            ]
        ]);
        $response->assertSee("success");
        $response->assertStatus(200);
    }
}
