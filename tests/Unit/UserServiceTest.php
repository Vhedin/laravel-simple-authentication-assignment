<?php
namespace Tests\Unit\Services;

use App\Events\UserSaved;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;

    /**
     * Set up the test
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->userService = new UserService();
    }

    /**
     * Test Store User
     * @test
     * @return void
     */
    public function it_can_store_a_user()
    {
        Event::fake();
        $data = [
            'name'      => 'IQBAL HASAN',
            'email'     => 'info@iqbalhasan.dev',
            'password'  => Hash::make('password'),
            'addresses' => [
                [
                    'address' => '123 Main St',
                    'city'    => 'New York',
                    'country' => 'NY',
                ]
            ]
        ];

        $user = $this->userService->store($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
    }


    /**
     * Test Update User
     * @test
     * @return void
     */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $updatedData = [
            'name'  => 'Updated Name',
            'email' => 'updated@example.com',

        ];

        $updatedUser = $this->userService->update($user->id, $updatedData);

        $this->assertEquals($updatedData['name'], $updatedUser->name);
        $this->assertEquals($updatedData['email'], $updatedUser->email);
    }

    /**
     * Test Delete User
     * @test
     * @return void
     */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $result = $this->userService->delete($user->id);

        $this->assertTrue($result);
        $this->assertNull(User::find($user->id));
    }

    /**
     * Test Restore User
     * @test
     * @return void
     */
    public function it_can_restore_a_deleted_user()
    {
        $user = User::factory()->create();
        $user->delete();

        $restoredUser = $this->userService->restore($user->id);

        $this->assertEquals($user->id, $restoredUser->id);
        $this->assertFalse($user->fresh()->trashed());
    }

    /**
     * Test Force Delete User
     * @test
     * @return void
     */
    public function it_can_force_delete_a_user()
    {
        $user = User::factory()->create();

        // Mock profile photo deletion
        Storage::fake('public');
        $user->profile_photo_path = 'path/to/profile/photo.jpg';
        $user->save();

        $result = $this->userService->forceDelete($user->id);

        $this->assertTrue($result);
        $this->assertNull(User::find($user->id));
        Storage::disk('public')->assertMissing($user->profile_photo_path);
    }

    /**
     * Test Paginate Users
     * @test
     * @return void
     */
    public function it_can_paginate_users()
    {
        User::factory()->count(30)->create();

        $users = $this->userService->paginate(10);

        $this->assertCount(10, $users);
    }


    /**
     * Test Paginate Trashed Users
     * @test
     * @return void
     */
    public function it_can_paginate_trashed_users()
    {
        User::factory()->count(20)->create();
        User::factory()->count(10)->create(['deleted_at' => now()]);

        $trashedUsers = $this->userService->onlyTrashedPaginate(10);

        $this->assertCount(10, $trashedUsers);
    }
}
