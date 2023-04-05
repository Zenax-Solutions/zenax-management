<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerDetails;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerAllCustomerDetailsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_customer_all_customer_details()
    {
        $customer = Customer::factory()->create();
        $allCustomerDetails = CustomerDetails::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.all-customer-details.index', $customer)
        );

        $response->assertOk()->assertSee($allCustomerDetails[0]->businuss_name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_all_customer_details()
    {
        $customer = Customer::factory()->create();
        $data = CustomerDetails::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.all-customer-details.store', $customer),
            $data
        );

        $this->assertDatabaseHas('customer_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $customerDetails = CustomerDetails::latest('id')->first();

        $this->assertEquals($customer->id, $customerDetails->customer_id);
    }
}
