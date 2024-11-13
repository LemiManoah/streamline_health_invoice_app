<?php
use Database\Factories\UserFactory;
use App\Models\User;

// Test for admin user can view users list page
test('admin user can view users list page', function () {
    $admin = User::factory()->admin()->create();

    // Authenticate the user
    $this->actingAs($admin);

    $response = $this->get('/users');

    $response->assertStatus(200);
});

// Test for cashier user cannot view users list page
test('cashier user cannot view users list page', function () {
    $cashier = User::factory()->cashier()->create();

    // Authenticate the user
    $this->actingAs($cashier);

    $response = $this->get('/users');

    $response->assertStatus(403);
});

// Test for creating a new user
test('admin user can create a new user', function () {
    $admin = User::factory()->admin()->create();

   $this->actingAs($admin)->get('/users/create')->assertStatus(200);

   $newUser = [
    'name' => 'Joshua Deo',
    'email' => 'joshuadeo@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123',
    'roles' => ['cashier']
   ];

   $this->actingAs($admin)->post('/users', $newUser)->assertRedirect();

   $latestUser = User::latest('id')->first();
   
   expect($latestUser)
   ->name->toBe($newUser['name'])
   ->email->toBe($newUser['email']);


});

// Test for updating an existing user
test('admin user can update an existing user', function () {
    $admin = User::factory()->admin()->create();
    // Authenticate the user
    $this->actingAs($admin);

    $user = [
        'name' => 'Martha Doe',
        'email' => 'marthadoe@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'roles' => ['cashier']
       ];

       $this->actingAs($admin)->post('/users', $user)->assertRedirect();

    $updatedData = ['name' => 'Josh Deo', 'email' => 'joshdeo@example.com'];

    $response = $this->put("/users/{$user->id}", $updatedData);

    $response->assertStatus(302); // Redirect after successful update
    $this->assertDatabaseHas('users', $updatedData);
});

// Test for deleting a user
test('admin user can delete a user', function () {
    $admin = User::factory()->admin()->create();
    $user = User::factory()->create();

    // Authenticate the user
    $this->actingAs($admin);

    $response = $this->delete("/users/{$user->id}");

    $response->assertStatus(302); // Redirect after successful deletion
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});