# Lekcja 02 — Temat 07: Połączenie z bazą i migracje

[Spis lekcji](../README.md) · [Główny spis zadań](../../../README.md)

Załączniki zawierają **dwa osobne zadania**. Oba wykonano we wspólnym projekcie Laravel 12 i bazie MariaDB `project`.

| Zadanie | Instrukcja | Adres po uruchomieniu |
|---|---|---|
| 7A — dodawanie użytkowników, `ex7 (1).pdf` | [Formularz i tabela user](cwiczenie_07a_uzytkownicy.txt) | `http://127.0.0.1:8000/adduser` |
| 7B — Faker, `zad_faker.PNG` | [Książki, seeder i sprawdzanie tytułu](cwiczenie_07b_faker.txt) | `http://127.0.0.1:8000/books`, `/check` |

## Zadanie 7A

[Kontroler User](../../../project_1/app/Http/Controllers/User.php) zapisuje imię, nazwisko i datę urodzenia do tabeli **`user`**. [Widok adduser](../../../project_1/resources/views/adduser.blade.php) wysyła POST `/User` z tokenem CSRF. Odpowiedź zawiera rekordy w JSON, zgodnie z przykładem w PDF. Kolumnę `create_user` wypełnia baza.

Rekordy można także pokazać w czytelnej tabeli pod `/user-records`.

## Zadanie 7B

[BooksTableSeeder](../../../project_1/database/seeders/BooksTableSeeder.php) dodaje 10 losowych książek z Faker oraz stały rekord „The Catcher in the Rye”, aby można było odtworzyć polecenie z zadania. Tytuły są unikalne.

```powershell
php artisan db:seed --class=BooksTableSeeder
php artisan db:seed --class=BooksTableSeeder --check="The Catcher in the Rye"
```

Funkcja `check_book_title` korzysta z `DB::table('books')->where(...)`. Jeśli książka istnieje, terminal i [widok /check](../../../project_1/resources/views/check.blade.php) pokazują błąd z nazwą oraz link do jej wiersza na `/books`. Jeśli nie istnieje, nie ma komunikatu błędu.

`--check` jest opcją dodaną w [SeedWithBookCheck](../../../project_1/app/Console/Commands/SeedWithBookCheck.php); standardowy Artisan nie ma tej opcji. Rozszerzenie zachowuje zwykłe działanie `db:seed`. Materiał Faker wspomina Laravel 10, a projekt pozostaje w wymaganym na zajęciach Laravel 12.

## Baza na komputerze uczelnianym

Włącz MySQL/MariaDB w XAMPP, utwórz bazę `project` w phpMyAdmin, skopiuj `.env.example` do `.env` i dostosuj dane połączenia. `php artisan migrate` odtworzy tabele, a seeder wygeneruje książki. Instrukcje obu zadań zawierają komplet poleceń.
