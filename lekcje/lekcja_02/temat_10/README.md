# Temat 10 — API

[Spis lekcji 02](../README.md) · [Instrukcja ćwiczenia 10](cwiczenie_10.txt)

Ćwiczenie z `e10.pdf`: pobranie JSON z API NBP, wyświetlenie kursów kupna i sprzedaży oraz przeliczenie złotych na pełne jednostki EUR, CHF i USD.

| Adres do skopiowania | Wynik do pokazania |
|---|---|
| `http://127.0.0.1:8000/kursy` | Tabela trzech walut: kupno (skup), sprzedaż, numer i data publikacji |
| `http://127.0.0.1:8000/kalkulatorwalut` | Formularz: wpisz 200 PLN, zaznacz CHF, kliknij Przelicz; poniżej wynik całkowity |

Kalkulator dzieli kwotę przez **kurs sprzedaży** i zaokrągla w dół. Wynik z przykładu w PDF zależy od aktualnego kursu. Aplikacja korzysta z ostatniej opublikowanej tabeli C, także w weekend. Do pobrania kursów potrzebne jest połączenie z Internetem; ćwiczenie nie dodaje tabel ani danych do bazy.

Kod: [NbpApi](../../../project_1/app/Services/NbpApi.php), [CurrencyController](../../../project_1/app/Http/Controllers/CurrencyController.php), [widoki](../../../project_1/resources/views/currency/), [routing](../../../project_1/routes/web.php).

Dokumentacja źródła danych: [NBP Web API](https://api.nbp.pl/).
