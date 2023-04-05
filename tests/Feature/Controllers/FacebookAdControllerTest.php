<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FacebookAd;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FacebookAdControllerTest extends TestCase
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
    public function it_displays_index_view_with_facebook_ads()
    {
        $facebookAds = FacebookAd::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('facebook-ads.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.facebook_ads.index')
            ->assertViewHas('facebookAds');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_facebook_ad()
    {
        $response = $this->get(route('facebook-ads.create'));

        $response->assertOk()->assertViewIs('app.facebook_ads.create');
    }

    /**
     * @test
     */
    public function it_stores_the_facebook_ad()
    {
        $data = FacebookAd::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('facebook-ads.store'), $data);

        $this->assertDatabaseHas('facebook_ads', $data);

        $facebookAd = FacebookAd::latest('id')->first();

        $response->assertRedirect(route('facebook-ads.edit', $facebookAd));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_facebook_ad()
    {
        $facebookAd = FacebookAd::factory()->create();

        $response = $this->get(route('facebook-ads.show', $facebookAd));

        $response
            ->assertOk()
            ->assertViewIs('app.facebook_ads.show')
            ->assertViewHas('facebookAd');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_facebook_ad()
    {
        $facebookAd = FacebookAd::factory()->create();

        $response = $this->get(route('facebook-ads.edit', $facebookAd));

        $response
            ->assertOk()
            ->assertViewIs('app.facebook_ads.edit')
            ->assertViewHas('facebookAd');
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

        $response = $this->put(
            route('facebook-ads.update', $facebookAd),
            $data
        );

        $data['id'] = $facebookAd->id;

        $this->assertDatabaseHas('facebook_ads', $data);

        $response->assertRedirect(route('facebook-ads.edit', $facebookAd));
    }

    /**
     * @test
     */
    public function it_deletes_the_facebook_ad()
    {
        $facebookAd = FacebookAd::factory()->create();

        $response = $this->delete(route('facebook-ads.destroy', $facebookAd));

        $response->assertRedirect(route('facebook-ads.index'));

        $this->assertModelMissing($facebookAd);
    }
}
