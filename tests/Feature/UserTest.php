<?php
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;// Test for admin user can view users list page
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

//update
test('admin user can update an existing user', function () {
    // Create an admin user
    $admin = User::factory()->admin()->create();

    // Create a user to be updated
    $user = User::factory()->create();

    // Authenticate the admin user
    $this->actingAs($admin);

    // Define the updated user data
    $updatedUserData = [
        'name' => 'Jane Doe',
        'email' => 'jane.doe@example.com',
    ];
 
    // Make a PUT request to the users update endpoint
    $response = $this->put('/users/' . $user->id, $updatedUserData);

    // Assert that the response has a 302 status code (redirect)
    $response->assertStatus(302);

    // Refresh the user from the database
    $updatedUser = $user->refresh();

    // Assert that the user was updated
    $this->assertEquals($updatedUserData['name'], $updatedUser->name);
    $this->assertEquals($updatedUserData['email'], $updatedUser->email);
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

test('validation errors when creating user', function() {
    // Create an admin user to authenticate and access restricted routes
    $admin = User::factory()->admin()->create();

    // Simulate accessing the user creation page and verify it loads successfully
    $this->actingAs($admin)->get('/users/create')->assertStatus(200);

    // Prepare new user data, intentionally omitting the 'password' field
    $newUser = [
        'name' => 'Joshua Deo',
        'email' => 'joshuadeo@example.com',
        // Missing 'password' to trigger validation error
        'password_confirmation' => 'password123',
        'roles' => ['cashier']
    ];

    // Submit the new user data and assert the system redirects 
    $this->actingAs($admin)->post('/users', $newUser)->assertRedirect();

    // Fetch the most recently created user to check if the invalid data was saved
    $latestUser = User::latest('id')->first();

    // Assert that the latest user does not match the attempted invalid data
    expect($latestUser)
        ->name->not->toBe($newUser['name'])
        ->email->not->toBe($newUser['email']);
});
