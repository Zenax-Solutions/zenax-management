<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\FacebookAd;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FacebookAdCustomersTest extends TestCase
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
    public function it_gets_facebook_ad_customers()
    {
        $facebookAd = FacebookAd::factory()->create();
        $customers = Customer::factory()
            ->count(2)
            ->create([
                'facebook_ad_id' => $facebookAd->id,
            ]);

        $response = $this->getJson(
            route('api.facebook-ads.customers.index', $facebookAd)
        );

        $response->assertOk()->assertSee($customers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_facebook_ad_customers()
    {
        $facebookAd = FacebookAd::factory()->create();
        $data = Customer::factory()
            ->make([
                'facebook_ad_id' => $facebookAd->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.facebook-ads.customers.store', $facebookAd),
            $data
        );

        $this->assertDatabaseHas('customers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $customer = Customer::latest('id')->first();

        $this->assertEquals($facebookAd->id, $customer->facebook_ad_id);
    }
}
