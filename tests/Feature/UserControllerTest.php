<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public $user;

    /**
     * Set up the test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        // Authenticate the user
        $this->actingAs($this->user);
    }

    /**
     * Test User Index
     *
     * @test
     */
    public function test_index()
    {
        // Visit user index route
        $response = $this->get(route('user.index'));

        // Assert that the response status is 200
        $response->assertStatus(200);
        // check view is user.index
        $response->assertViewIs('user.index');
        // check view has collection
        $response->assertViewHas('collection');
        // check collection has $user
        $response->assertSee($this->user->name);
    }

    /**
     * Test Create User
     *
     * @test
     */
    public function test_create()
    {
        // Visit user create route
        $response = $this->get(route('user.create'));

        // Assert that the response status is 200
        $response->assertStatus(200);
        // check view is user.create
        $response->assertViewIs('user.create_edit');
    }

    /**
     * Test Store User
     *
     * @test
     */
    public function test_store()
    {
        // Create a user
        $user = [
            'name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'password' => 'admin12345678',
            'password_confirmation' => 'admin12345678',
            'addresses' => [
                [
                    'address' => '123 Main St',
                    'city' => 'New York',
                    'country' => 'NY',
                ],
            ],

        ];

        // Visit user store route
        $response = $this->post(route('user.store'), $user);

        // Assert that the response status is 302
        $response->assertStatus(302);
        // check user is created
        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }

    /**
     * Test Show User
     *
     * @test
     */
    public function test_show()
    {
        // Visit user show route
        $response = $this->get(route('user.show', $this->user->id));

        // Assert that the response status is 200
        $response->assertStatus(200);
        // check view is user.show
        $response->assertViewIs('user.show');
        // check view has user
        $response->assertViewHas('item');
        // check user is $user
        $response->assertSee($this->user->name);
    }

    /**
     * Test edit User
     *
     * @test
     */
    public function test_edit()
    {
        // Visit user edit route
        $response = $this->get(route('user.edit', $this->user->id));

        // Assert that the response status is 200
        $response->assertStatus(200);
        // check view is user.create
        $response->assertViewIs('user.create_edit');
        // check view has user
        $response->assertViewHas('item');
        // check user is $user
        $response->assertSee($this->user->name);
    }

    /**
     * Test Update User
     *
     * @test
     */
    public function test_update()
    {
        // Update a user
        $user = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'addresses' => [
                [
                    'address' => '123 Main St',
                    'city' => 'New York',
                    'country' => 'NY',
                ],
                [
                    'address' => '123 Main St',
                    'city' => 'New York',
                    'country' => 'NY',
                ],
            ],
        ];

        // Visit user update route
        $response = $this->put(route('user.update', $this->user->id), $user);

        // Assert that the response status is 302
        $response->assertStatus(302);
        // check user is updated
        $this->assertDatabaseHas('users', ['email' => $user['email']]);
    }

    /**
     * Test Delete User
     *
     * @test
     */
    public function test_destroy()
    {
        // create new user
        $user = User::factory()->create();
        // Visit user destroy route
        $response = $this->delete(route('user.destroy', $user->id));

        // Assert that the response status is 200
        $response->assertStatus(200);
        // check user is deleted
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    /**
     * Test Force Destroy User
     *
     * @test
     */
    public function test_force_destroy()
    {
        // create new user
        $user = User::factory()->create();
        // Visit user destroy route
        $response = $this->delete(route('user.destroy', $user->id), ['force_delete' => true]);

        // Assert that the response status is 200
        $response->assertStatus(200);
        // check user is deleted
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
     * Test Restore User
     *
     * @test
     */
    public function test_restore()
    {
        // create new user
        $user = User::factory()->create();
        // delete user
        $user->delete();
        // Visit user restore route
        $response = $this->post(route('user.restore', $user->id));

        // Assert that the response status is 302
        $response->assertStatus(302);
        // check user is restored
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}
