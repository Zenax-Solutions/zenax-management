<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CustomerDetails;

use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerDetailsTest extends TestCase
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
    public function it_gets_all_customer_details_list()
    {
        $allCustomerDetails = CustomerDetails::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-customer-details.index'));

        $response->assertOk()->assertSee($allCustomerDetails[0]->businuss_name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_details()
    {
        $data = CustomerDetails::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.all-customer-details.store'),
            $data
        );

        $this->assertDatabaseHas('customer_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_customer_details()
    {
        $customerDetails = CustomerDetails::factory()->create();

        $customer = Customer::factory()->create();

        $data = [
            'businuss_name' => $this->faker->text(255),
            'email' => $this->faker->email,
            'number' => $this->faker->randomNumber,
            'address' => $this->faker->address,
            'about' => $this->faker->text,
            'qoutation' => $this->faker->text,
            'customer_id' => $customer->id,
        ];

        $response = $this->putJson(
            route('api.all-customer-details.update', $customerDetails),
            $data
        );

        $data['id'] = $customerDetails->id;

        $this->assertDatabaseHas('customer_details', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_customer_details()
    {
        $customerDetails = CustomerDetails::factory()->create();

        $response = $this->deleteJson(
            route('api.all-customer-details.destroy', $customerDetails)
        );

        $this->assertModelMissing($customerDetails);

        $response->assertNoContent();
    }
}
