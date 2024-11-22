<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

test('admin user can see the index of roles', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/roles')
        ->assertStatus(200);

    
});

test('non admin user cannot see the index of roles', function () {
    $cahier = User::factory()->cashier()->create();

    $this->actingAs($cahier)
        ->get('/roles')
        ->assertStatus(403);

});

//creating a new role
test('admin creating a new role', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)
        ->get('/roles/create')
        ->assertStatus(200);

    $newRole = Role::create([
        'name' => 'Manager',

    ]);

    $this->post('/roles', [$newRole])
        ->assertStatus(302);

    $this->assertDatabaseHas('roles', ['name' => 'Manager']);
   
   expect($newRole)
   ->name->toBe($newRole['name']);
});

//updating an existing role
test('admin user can update an existing role', function () {
    $admin = User::factory()->admin()->create();
    $this->actingAs($admin);

    $role = Role::create([
        'name' => 'Software Product Manager',
    ]);

    $updatedRole = [
        'name' => 'Director',
    ];

    $response = $this->put('/roles/' . $role->id, $updatedRole);

    $response->assertStatus(302);
    $this->assertDatabaseHas('roles', $updatedRole);
});

test('admin user can delete an existing role', function () {
    $admin = User::factory()->admin()->create();

    $role = Role::create([
        'name' => 'Product Manager',
    ]);

    $this->actingAs($admin);
    $response = $this->delete("roles/{$role->id}");
    $response->assertStatus(302);

    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
});
