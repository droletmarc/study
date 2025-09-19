<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    // public function test_login_form(): void {
    //     $response = $this->get('/login');
    //     $response->assertStatus(200);
    //     $this->assertTrue(true);
    // }

    // public function test_user_duplication() {
    //     $user1 = User::make([
    //         'name' => 'John',
    //         'email' => 'john@tesst.com'
    //     ]);

    //     $user2 = User::make([
    //         'name' => 'John2',
    //         'email' => 'john@test2.com'
    //     ]);

    //     $this->assertTrue($user1->name != $user2->name);
    // }

    // public function test_delete_user() {
    //     $user = User::factory()->count(1)->make();

    //     $user = User::first();
    //     if ($user) {
    //         $user->delete();
    //     }

    //     $this->assertTrue(true);
    // }

    // public function test_it_store_new_user(): void {
    //     $response = $this->post('/users', [
    //         'name' => 'Test',
    //         'email' => 'test@test.com',
    //         'password' => 'test123',
    //         'password_confirmation' => 'test123'
    //     ]);
    //     $response->assertRedirect('/');
    // }

    // public function test_database() {
    //     $this->assertDatabaseHas('users', [
    //         'name' => 'John'
    //     ]);

    //     // $this->assertDatabaseMissing('users', [
    //     //     'name' => 'John'
    //     // ]);
    // }

    // public function test_if_seeders_works() {
    //     // $this->seed(); // seed all seeders in the folder
    // }
}
