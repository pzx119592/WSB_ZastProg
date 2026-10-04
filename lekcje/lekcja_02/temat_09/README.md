# Lekcja 02 — Temat 09: Modele

[Spis lekcji](../README.md) · [Główny spis zadań](../../../README.md)

Zadania wykonano w kolejności załączników: **9A — `e24.pdf`**, następnie **9B — `e24_v1.pdf`**.

| Ćwiczenie | Instrukcja | Adres po uruchomieniu |
|---|---|---|
| 9A — model Book, migracja, 3 książki i lista | [e24 — lista książek](cwiczenie_09a_e24.txt) | `http://127.0.0.1:8000/temat-9/books` |
| 9B — formularz i model Test | [e24_v1 — zapis i lista rekordów](cwiczenie_09b_e24_v1.txt) | `/temat-9/dbTestTableForm`, `/temat-9/ModelTestController` |

## Zachowanie poprzednich ćwiczeń

Temat 7 nadal ma `/books`, swoją tabelę `books`, kontroler `BooksController` i `BooksTableSeeder`. Dla tematu 9 utworzono osobną tabelę **`books_temat9`**, wskazaną w modelu `Book`, oraz adresy z prefiksem **`/temat-9/`**. To celowa zmiana nazw względem PDF, zgodna z prośbą o zachowanie każdego ćwiczenia w jego wcześniejszej postaci. Migracje dodają nowe tabele; nie przebudowują wcześniejszych danych.

## 9A — e24

Artisan wygenerował [model Book](../../../project_1/app/Models/Book.php), [BookController](../../../project_1/app/Http/Controllers/BookController.php), migrację `books_temat9` i [BookSeeder](../../../project_1/database/seeders/BookSeeder.php). Tabela ma `id`, `title`, `year`, `price`, `pages`, `publication_place`, `created_at` (data dodania) i `updated_at`.

`BookSeeder` dodaje trzy przykładowe książki z kompletem danych. Powtórne uruchomienie nie tworzy duplikatów. Kontroler pobiera dane przez Eloquent i zwraca [widok book.list](../../../project_1/resources/views/book/list.blade.php), który pokazuje nagłówek „Lista książek” i wypunktowane `Tytuł: …`, jak w PDF.

## 9B — e24_v1

[Formularz](../../../project_1/resources/views/test/form.blade.php) zawiera imię, nazwisko, e-mail, datę urodzenia i wzrost. [ModelTestController](../../../project_1/app/Http/Controllers/ModelTestController.php) waliduje dane i zapisuje je przez `Test::create(...)`. [Model Test](../../../project_1/app/Models/Test.php) korzysta z tabeli `tests`, automatycznie wypełnia daty i formatuje wzrost do dwóch miejsc dziesiętnych.

Po POST następuje przekierowanie na [listę rekordów](../../../project_1/resources/views/test/list.blade.php); pokazuje ona wszystkie rekordy z tekstem `Imię i nazwisko: …, email: …` oraz pozostałymi polami. Odświeżenie listy nie wysyła formularza ponownie. Rekordy `tests` nie są kontami do logowania i nie trafiają do `users` ani `user`.

## Pobranie i odtworzenie

Instrukcje TXT zawierają pełne przygotowanie XAMPP, MariaDB, Composera i `.env`, adresy do pokazania, pliki do otwarcia oraz przykłady użycia modeli. Wariant z tymi samymi danymi: [kopia SQL tematu 9](../../../baza/temat_09_dane_przykladowe.sql) i [instrukcja importu](../../../baza/instrukcja_importu_temat_09.txt).

Dokumentacja: [modele Eloquent w Laravel 12](https://laravel.com/docs/12.x/eloquent).
