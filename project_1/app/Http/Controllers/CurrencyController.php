<?php

namespace App\Http\Controllers;

use App\Services\NbpApi;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RuntimeException;

class CurrencyController extends Controller
{
    private const API_ERROR = 'Nie udało się pobrać kursów NBP. Sprawdź połączenie z Internetem i spróbuj ponownie.';

    public function rates(NbpApi $api)
    {
        try {
            return view('currency.rates', ['table' => $api->table(), 'apiError' => null]);
        } catch (ConnectionException|RequestException|RuntimeException $exception) {
            report($exception);

            return response()->view('currency.rates', ['table' => null, 'apiError' => self::API_ERROR], 503);
        }
    }

    public function calculator()
    {
        return view('currency.calculator', ['currencies' => NbpApi::CURRENCIES]);
    }

    public function convert(Request $request, NbpApi $api)
    {
        if (is_string($request->input('amount'))) {
            $request->merge(['amount' => str_replace(',', '.', trim($request->input('amount')))]);
        }
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'decimal:0,2', 'gt:0', 'max:1000000000'],
            'currency' => ['required', Rule::in(array_keys(NbpApi::CURRENCIES))],
        ], [
            'amount.required' => 'Podaj kwotę w złotych.',
            'amount.numeric' => 'Kwota musi być liczbą.',
            'amount.decimal' => 'Kwota może mieć maksymalnie 2 miejsca po przecinku.',
            'amount.gt' => 'Kwota musi być większa od zera.',
            'amount.max' => 'Maksymalna kwota to 1 000 000 000 zł.',
            'currency.required' => 'Wybierz walutę.',
            'currency.in' => 'Wybierz EUR, CHF lub USD.',
        ]);

        $viewData = ['currencies' => NbpApi::CURRENCIES, 'amount' => $data['amount'], 'currency' => $data['currency']];
        try {
            $table = $api->table();
        } catch (ConnectionException|RequestException|RuntimeException $exception) {
            report($exception);

            return response()->view('currency.calculator', $viewData + ['apiError' => self::API_ERROR], 503);
        }

        $ask = $table['rates'][$data['currency']]['ask'];
        // Kwota w groszach i kurs w jednostkach 0,0001 PLN: dokładne dzielenie całkowite.
        $amountInGrosze = (int) round((float) $data['amount'] * 100);
        $rateInUnits = (int) round((float) $ask * 10000);
        $result = intdiv($amountInGrosze * 100, $rateInUnits);

        return view('currency.calculator', $viewData + compact('table', 'ask', 'result'));
    }
}
