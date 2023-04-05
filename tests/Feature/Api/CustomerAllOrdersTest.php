<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Orders;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerAllOrdersTest extends TestCase
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
    public function it_gets_customer_all_orders()
    {
        $customer = Customer::factory()->create();
        $allOrders = Orders::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.all-orders.index', $customer)
        );

        $response->assertOk()->assertSee($allOrders[0]->payment_status);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_all_orders()
    {
        $customer = Customer::factory()->create();
        $data = Orders::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.all-orders.store', $customer),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $orders = Orders::latest('id')->first();

        $this->assertEquals($customer->id, $orders->customer_id);
    }
}
