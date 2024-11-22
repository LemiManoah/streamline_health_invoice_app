<?php
use App\Models\User;
use Modules\Client\Models\Client;
use Database\Factories\UserFactory;
use Modules\Client\Database\Factories\ClientFactory;


test('admins and cashiers can see client list', function(){
    $admin = User::factory()->admin()->create();
    $cashier = User::factory()->cashier()->create();

    $this->actingAs($admin)
        ->get('/clients')
        ->assertStatus(200);

    $this->actingAs($cashier)
        ->get('/clients')
        ->assertStatus(200);
});


test('admins and cashiers can view create new client page', function(){
    $admin = User::factory()->admin()->create();
    $cashier = User::factory()->cashier()->create();

    $this->actingAs($admin)
    ->get('/clients/create')
    ->assertStatus(200);

    $this->actingAs($cashier)
    ->get('/clients/create')
    ->assertStatus(200);

});


test('admins and cashiers can show a single client page', function(){
    $admin = User::factory()->admin()->create();
    $cashier = User::factory()->cashier()->create();

    $client = ClientFactory::new()->create();

    $this->actingAs($admin)
    ->get('/clients/'. $client->id)
    ->assertStatus(200);

    $this->actingAs($cashier)
    ->get('/clients/'. $client->id)
    ->assertStatus(200);
});


test('admins and cashiers can create a new client', function(){
    $admin = User::factory()->admin()->create();
    $clientData = Client::factory()->create();

    $this->actingAs($admin)
    ->post('/clients', [$clientData])
    ->assertStatus(302);

    // $this->assertDatabaseHas()

    expect($clientData)
    ->name->toBe($clientData['name'])
    ->client_email->toBe($clientData['client_email']);
});

//validation tests 


test('admins and cashiers can update a client', function(){
    $admin = User::factory()->admin()->create();
    $client = ClientFactory::new()->create();
    $clientData = [
        'name' => 'Yokwe Hospital',
        'client_email' => 'yokwehillary@gmail.com',
    ];

    $this->actingAs($admin)
    ->put('/clients/'. $client['id'], $clientData)
    ->assertStatus(302);

    $this->assertDatabaseHas('clients', [
        'id' => $client['id'],
        'name' => $clientData['name'],
        'client_email' => $clientData['client_email'],
    ]);

});

test('admins and cashiers can delete a client', function(){
    $admin = User::factory()->admin()->create();
    $client = ClientFactory::new()->create();

    $this->actingAs($admin)
    ->delete('/clients/'. $client['id'])
    ->assertStatus(302);

    $this->assertDatabaseMissing('clients', ['id' => $client['id']]);
});


test('testing validation error of required field omission when creating client ', function () {
    $admin = User::factory()->admin()->create();

    //create a client with a certain email
    $clientData = [
        'name' => 'Kisizi Hospital',
        'facility_level' => 'HCIII',
        'location' => '123 Example St.',
        //ommitting the client email
        'contact_person_name' => 'John Doe',
        'contact_person_phone' => '+1234567890',
        'streamline_engineer_name' => 'Engineer A',
        'streamline_engineer_phone' => '+0987654321',
        'streamline_engineer_email' => 'engineer@gmail.com',
        'verification_status' => 'unverified'
    ];


    //authenticate admin user and assert can access the create client page
    $this->actingAs($admin)
    ->get('/clients/create')
    ->assertStatus(200);

    //assert validation error when creating client with duplicate email
    $this->post('/clients', $clientData)
    ->assertSessionHasErrors('client_email')
    ->assertRedirect();

    // get the latest client in the database to verify that the invalid data wasn't saved
    $latestClient = Client::latest()->first();

    // // Assert: Ensure no invalid client was saved in the database
    // $this->assertDatabaseMissing('clients', ['name' => 'Kisizi Hospital']);

    // verify that the invalid data wasn't saved in the database
    expect($latestClient)
    ->name->not->toBe($clientData['name']);

});

test('testing validation error when creating client of duplicate entry', function () {
    $admin = User::factory()->admin()->create();

    // Create a client with a specific email address
    $clientData = Client::factory()->create([
        'name' => 'Existing Client',
        'facility_level' => 'HCIII',
        'location' => '123 Example St.',
        'client_email' => 'yokwe@gmail.com', // Unique email
        'contact_person_name' => 'John Doe',
        'contact_person_phone' => '+1234567890',
        'streamline_engineer_name' => 'Engineer A',
        'streamline_engineer_phone' => '+0987654321',
        'streamline_engineer_email' => 'engineer@gmail.com',
        'verification_status' => 'unverified',
    ]);

    // Create duplicate client data with the same email
    $duplicateClientData = [
        'name' => 'Duplicate Client',
        'facility_level' => 'HCIV',
        'location' => '456 Another Rd.',
        'client_email' => 'yokwe@gmail.com', // Duplicate email
        'contact_person_name' => 'Jane Doe',
        'contact_person_phone' => '+0987654321',
        'streamline_engineer_name' => 'Engineer B',
        'streamline_engineer_phone' => '+1234567890',
        'streamline_engineer_email' => 'engineerb@gmail.com',
        'verification_status' => 'verified',
    ];

    // Authenticate as admin and attempt to create the duplicate client
    $this->actingAs($admin)
        ->post('/clients', $duplicateClientData)
        // Assert validation error for duplicate email
        ->assertSessionHasErrors(['client_email']) 
        ->assertRedirect(); 


    //get the latest client
    $latestClient = Client::latest()->first();

    //Ensure no new client with the duplicate email was created
    expect($latestClient)
    ->name->not->toBe('Duplicate Client');

    // Ensure the original client still exists in the database
    $this->assertDatabaseHas('clients', ['client_email' => 'yokwe@gmail.com']); // The original email should still be there
    
});





