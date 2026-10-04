<?php

namespace Tests\Feature;

use App\Services\NbpApi;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CurrencyApiTest extends TestCase
{
    public function test_rates_show_only_three_required_currencies_with_buy_and_sell_prices(): void
    {
        $this->fakeTable();
        $this->get('/kursy')->assertOk()->assertSee('Euro')->assertSee('Frank szwajcarski')
            ->assertSee('Dolar amerykański')->assertSee('3,9000 zł')->assertSee('4,0000 zł')
            ->assertSee('2026-10-02')->assertDontSee('Funt szterling');
        Http::assertSent(fn ($request) => $request->url() === NbpApi::URL
            && $request->hasHeader('Accept', 'application/json'));
    }

    public function test_calculator_form_has_csrf_and_does_not_need_an_api_request(): void
    {
        Http::preventStrayRequests();
        Http::fake();
        $this->get('/kalkulatorwalut')->assertOk()->assertSee('name="_token"', false)
            ->assertSee('value="EUR"', false)->assertSee('value="CHF"', false)->assertSee('value="USD"', false);
        Http::assertNothingSent();
    }

    public function test_purchase_uses_sell_price_and_truncates_fractional_units_for_each_currency(): void
    {
        $this->fakeTable();
        foreach (['EUR' => 47, 'CHF' => 50, 'USD' => 57] as $currency => $result) {
            $this->post('/kalkulatorwalut', ['amount' => '200', 'currency' => $currency])
                ->assertOk()->assertViewHas('result', $result)
                ->assertSee('Za kwotę 200,00 zł można zakupić '.$result.' '.strtolower($currency).'.');
        }
    }

    public function test_exact_boundary_and_comma_input_do_not_lose_a_unit_due_to_floating_point(): void
    {
        $this->fakeTable();
        $this->post('/kalkulatorwalut', ['amount' => '4,20', 'currency' => 'EUR'])
            ->assertOk()->assertViewHas('result', 1);
        $this->post('/kalkulatorwalut', ['amount' => '4.19', 'currency' => 'EUR'])
            ->assertOk()->assertViewHas('result', 0);
    }

    public function test_bad_input_is_rejected_before_calling_api_and_preserves_form_values(): void
    {
        Http::fake();
        foreach (['0', '-1', 'tekst', '1.234', '1000000001'] as $amount) {
            $this->from('/kalkulatorwalut')->post('/kalkulatorwalut', ['amount' => $amount, 'currency' => 'EUR'])
                ->assertRedirect('/kalkulatorwalut')->assertSessionHasErrors('amount');
        }
        $this->from('/kalkulatorwalut')->post('/kalkulatorwalut', ['amount' => '200', 'currency' => 'GBP'])
            ->assertSessionHasErrors('currency');
        $this->get('/kalkulatorwalut')->assertOk()->assertSee('value="200"', false)
            ->assertSee('Wybierz EUR, CHF lub USD.');
        Http::assertNothingSent();
    }

    public function test_api_http_failure_is_clear_and_does_not_display_a_fake_result(): void
    {
        Http::fake([NbpApi::URL => Http::response([], 503)]);
        $this->get('/kursy')->assertStatus(503)->assertSee('Nie udało się pobrać kursów NBP');
        $this->post('/kalkulatorwalut', ['amount' => '200', 'currency' => 'CHF'])
            ->assertStatus(503)->assertSee('Nie udało się pobrać kursów NBP')
            ->assertSee('value="200"', false)->assertDontSee('można zakupić');
    }

    public function test_connection_failure_and_incomplete_response_are_handled(): void
    {
        Http::fake([NbpApi::URL => Http::failedConnection()]);
        $this->get('/kursy')->assertStatus(503)->assertSee('Sprawdź połączenie z Internetem');
        Http::fake([NbpApi::URL => Http::response([['table' => 'C', 'no' => '1/C', 'effectiveDate' => '2026-10-02', 'rates' => []]])]);
        $this->get('/kursy')->assertStatus(503)->assertSee('Nie udało się pobrać kursów NBP');
    }

    public function test_conversion_post_is_protected_with_csrf(): void
    {
        Http::fake();
        $this->app->instance('env', 'local');
        $this->post('/kalkulatorwalut', ['amount' => '200', 'currency' => 'EUR'])->assertStatus(419);
        Http::assertNothingSent();
    }

    private function fakeTable(): void
    {
        Http::preventStrayRequests();
        Http::fake([NbpApi::URL => Http::response([[
            'table' => 'C', 'no' => '192/C/NBP/2026', 'effectiveDate' => '2026-10-02',
            'rates' => [
                ['code' => 'EUR', 'bid' => 4.0, 'ask' => 4.2],
                ['code' => 'CHF', 'bid' => 3.9, 'ask' => 4.0],
                ['code' => 'USD', 'bid' => 3.4, 'ask' => 3.5],
                ['code' => 'GBP', 'bid' => 5.0, 'ask' => 5.1, 'currency' => 'Funt szterling'],
            ],
        ]])]);
    }
}
