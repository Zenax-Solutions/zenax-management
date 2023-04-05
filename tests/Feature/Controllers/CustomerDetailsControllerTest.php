<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CustomerDetails;

use App\Models\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerDetailsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_customer_details()
    {
        $allCustomerDetails = CustomerDetails::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-customer-details.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_customer_details.index')
            ->assertViewHas('allCustomerDetails');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_customer_details()
    {
        $response = $this->get(route('all-customer-details.create'));

        $response->assertOk()->assertViewIs('app.all_customer_details.create');
    }

    /**
     * @test
     */
    public function it_stores_the_customer_details()
    {
        $data = CustomerDetails::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-customer-details.store'), $data);

        $this->assertDatabaseHas('customer_details', $data);

        $customerDetails = CustomerDetails::latest('id')->first();

        $response->assertRedirect(
            route('all-customer-details.edit', $customerDetails)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_customer_details()
    {
        $customerDetails = CustomerDetails::factory()->create();

        $response = $this->get(
            route('all-customer-details.show', $customerDetails)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_customer_details.show')
            ->assertViewHas('customerDetails');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_customer_details()
    {
        $customerDetails = CustomerDetails::factory()->create();

        $response = $this->get(
            route('all-customer-details.edit', $customerDetails)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.all_customer_details.edit')
            ->assertViewHas('customerDetails');
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

        $response = $this->put(
            route('all-customer-details.update', $customerDetails),
            $data
        );

        $data['id'] = $customerDetails->id;

        $this->assertDatabaseHas('customer_details', $data);

        $response->assertRedirect(
            route('all-customer-details.edit', $customerDetails)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_customer_details()
    {
        $customerDetails = CustomerDetails::factory()->create();

        $response = $this->delete(
            route('all-customer-details.destroy', $customerDetails)
        );

        $response->assertRedirect(route('all-customer-details.index'));

        $this->assertModelMissing($customerDetails);
    }
}
