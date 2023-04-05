<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Orders;

use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdersTest extends TestCase
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
    public function it_gets_all_orders_list()
    {
        $allOrders = Orders::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-orders.index'));

        $response->assertOk()->assertSee($allOrders[0]->payment_status);
    }

    /**
     * @test
     */
    public function it_stores_the_orders()
    {
        $data = Orders::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-orders.store'), $data);

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_orders()
    {
        $orders = Orders::factory()->create();

        $customer = Customer::factory()->create();
        $user = User::factory()->create();

        $data = [
            'discount' => $this->faker->randomNumber(0),
            'total' => $this->faker->randomNumber,
            'payment_status' => $this->faker->text(255),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'order_status' => $this->faker->text,
            'customer_id' => $customer->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.all-orders.update', $orders),
            $data
        );

        $data['id'] = $orders->id;

        $this->assertDatabaseHas('orders', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_orders()
    {
        $orders = Orders::factory()->create();

        $response = $this->deleteJson(route('api.all-orders.destroy', $orders));

        $this->assertModelMissing($orders);

        $response->assertNoContent();
    }
}
