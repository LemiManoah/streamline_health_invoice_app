<?php
use App\Models\User;
use Database\Factories\UserFactory;
use Modules\Invoice\Models\Invoice;
use Illuminate\Support\Facades\Artisan;
use Modules\Client\Models\Subscription;


test('admins and cashiers can see invoice list', function(){
    $admin = User::factory()->admin()->create();
    $cashier = User::factory()->cashier()->create();

    $this->actingAs($admin)
        ->get('/invoices')
        ->assertStatus(200);

    $this->actingAs($cashier)
        ->get('/invoices')
        ->assertStatus(200);
});


test('admins and cashiers can view create new invoice page', function(){
    $admin = User::factory()->admin()->create();
    $cashier = User::factory()->cashier()->create();

    $this->actingAs($admin)
    ->get('/invoices/create')
    ->assertStatus(200);

    $this->actingAs($cashier)
    ->get('/invoices/create')
    ->assertStatus(200);

});



test('scheduled task generates invoices for clients', function(){
    $admin = User::factory()->admin()->create();

    //create sibscriptions that are due for renewal
    $subscriptions = Subscription::factory()->count(3)->create([
        'next_billing_date' => now(),
        'status' => 'unpaid'
    ]);

    //Run the command
    Artisan::call('invoices:generate');

    //Assert that invoices were created for each subscription
    foreach ($subscriptions as $subscription) {
        $this->assertDatabaseHas('invoices', [
            'client_id' => $subscription->client_id,
            'total_amount' => $subscription->amount,
            
        ]);
    }

    test('send emails command sends the required emails', function () {
        
    });

   
});




