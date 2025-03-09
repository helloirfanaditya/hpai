<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $token;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->token = JWTAuth::fromUser($user);
    }

    public function test_create_user(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@examplehni.com',
            'password' => 'password123',
            'role' => rand(1, 2)
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$this->token}",
        ])->postJson('/api/users', $data);

        $response->assertStatus(200);
    }

    public function test_create_user_with_duplicate_email(): void
    {
        $existingUser = User::factory()->create([
            'email' => 'duplicate@example.com',
        ]);
        $roles = [1, 2];
        $data = [
            'name' => 'Jane Doe',
            'email' => 'duplicate@example.com',
            'password' => 'password123',
            'role_id' => $roles[array_rand($roles)],
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$this->token}",
        ])->postJson('/api/users', $data);

        $response->assertStatus(400);
    }

    public function test_get_user_detail()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$this->token}",
        ])->getJson("/api/users/{$user->id}");

        $response->assertStatus(200);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$this->token}",
        ])->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_login()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123')
        ]);

        $credentials = [
            'email' => 'user@example.com',
            'password' => 'password123'
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer {$this->token}",
        ])->postJson('/api/login', $credentials);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'token',
            ],
        ]);
    }
}
