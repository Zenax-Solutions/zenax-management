<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FacebookAd;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FacebookAdTest extends TestCase
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
    public function it_gets_facebook_ads_list()
    {
        $facebookAds = FacebookAd::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.facebook-ads.index'));

        $response->assertOk()->assertSee($facebookAds[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_facebook_ad()
    {
        $data = FacebookAd::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.facebook-ads.store'), $data);

        $this->assertDatabaseHas('facebook_ads', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_facebook_ad()
    {
        $facebookAd = FacebookAd::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'content' => $this->faker->text,
            'type' => $this->faker->word,
            'status' => $this->faker->text(255),
            'reach' => $this->faker->randomNumber(0),
            'leads' => $this->faker->randomNumber(0),
            'cost' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(
            route('api.facebook-ads.update', $facebookAd),
            $data
        );

        $data['id'] = $facebookAd->id;

        $this->assertDatabaseHas('facebook_ads', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_facebook_ad()
    {
        $facebookAd = FacebookAd::factory()->create();

        $response = $this->deleteJson(
            route('api.facebook-ads.destroy', $facebookAd)
        );

        $this->assertModelMissing($facebookAd);

        $response->assertNoContent();
    }
}
