<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class NbpApi
{
    public const URL = 'https://api.nbp.pl/api/exchangerates/tables/C/';

    public const CURRENCIES = [
        'EUR' => 'Euro',
        'CHF' => 'Frank szwajcarski',
        'USD' => 'Dolar amerykański',
    ];

    public function table(): array
    {
        // Bez /today: w weekend pobieramy ostatnią opublikowaną tabelę.
        $table = Http::acceptJson()->connectTimeout(5)->timeout(15)
            ->get(self::URL)->throw()->json('0');

        if (!is_array($table) || ($table['table'] ?? null) !== 'C'
            || empty($table['no']) || empty($table['effectiveDate'])
            || !is_array($table['rates'] ?? null)) {
            throw new RuntimeException('Niepoprawna tabela z API NBP.');
        }

        $rates = [];
        foreach (self::CURRENCIES as $code => $name) {
            $rate = collect($table['rates'])->firstWhere('code', $code);
            if (!is_array($rate) || !is_numeric($rate['bid'] ?? null)
                || !is_numeric($rate['ask'] ?? null)
                || $rate['bid'] <= 0 || $rate['ask'] <= 0) {
                throw new RuntimeException('Brak poprawnego kursu '.$code.'.');
            }
            $rates[$code] = ['name' => $name, 'bid' => $rate['bid'], 'ask' => $rate['ask']];
        }

        return ['number' => $table['no'], 'date' => $table['effectiveDate'], 'rates' => $rates];
    }
}
