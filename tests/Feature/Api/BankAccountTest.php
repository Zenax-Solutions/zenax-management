<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BankAccount;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankAccountTest extends TestCase
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
    public function it_gets_bank_accounts_list()
    {
        $bankAccounts = BankAccount::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.bank-accounts.index'));

        $response->assertOk()->assertSee($bankAccounts[0]->account_name);
    }

    /**
     * @test
     */
    public function it_stores_the_bank_account()
    {
        $data = BankAccount::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.bank-accounts.store'), $data);

        $this->assertDatabaseHas('bank_accounts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_bank_account()
    {
        $bankAccount = BankAccount::factory()->create();

        $user = User::factory()->create();

        $data = [
            'account_name' => $this->faker->text(255),
            'account_number' => $this->faker->randomNumber(0),
            'amount' => $this->faker->randomNumber(0),
            'withdrawal' => $this->faker->randomNumber(0),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.bank-accounts.update', $bankAccount),
            $data
        );

        $data['id'] = $bankAccount->id;

        $this->assertDatabaseHas('bank_accounts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_bank_account()
    {
        $bankAccount = BankAccount::factory()->create();

        $response = $this->deleteJson(
            route('api.bank-accounts.destroy', $bankAccount)
        );

        $this->assertModelMissing($bankAccount);

        $response->assertNoContent();
    }
}
