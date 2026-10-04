# Programowanie w zastosowaniach — WSB_ZastProg

Ćwiczenia z zajęć: PHP, XAMPP i Laravel 12. **Wybierz lekcję, temat i ćwiczenie**, aby znaleźć instrukcję, adres do pokazania i kod.

## Lekcja 01 — spis zadań

| Lekcja | Temat | Ćwiczenie | Zadanie / instrukcja | Wynik do pokazania po uruchomieniu |
|---|---|---|---|---|
| 01 | 01 | 1 | [Instalacja XAMPP](lekcje/lekcja_01/temat_01/cwiczenie_01.txt) | `http://localhost` |
| 01 | 01 | 2 | [Apache i MariaDB](lekcje/lekcja_01/temat_01/cwiczenie_02.txt) | `http://127.0.0.1/phpmyadmin` |
| 01 | 01 | 3 | [Pierwszy skrypt PHP](lekcje/lekcja_01/temat_01/cwiczenie_03.txt) | `http://localhost/pierwszy_skrypt/` |
| 01 | 01 | GitHub | [Umieszczenie projektu na GitHubie](lekcje/lekcja_01/temat_01/zadanie_github.txt) | Repozytorium i historia Git |
| 01 | 02 | 1 | [Sprawdzenie środowiska XAMPP](lekcje/lekcja_01/temat_02/cwiczenie_01.txt) | XAMPP i phpMyAdmin |
| 01 | 02 | 2 | [Composer i utworzenie Laravel 12](lekcje/lekcja_01/temat_02/cwiczenie_02.txt) | `php artisan --version`, struktura projektu |
| 01 | 03 | 1 | [Własny widok i CSS](lekcje/lekcja_01/temat_03/cwiczenie_01.txt) | `http://127.0.0.1:8000/` |
| 01 | 03 | 2 | [Routing i kontroler](lekcje/lekcja_01/temat_03/cwiczenie_02.txt) | `http://127.0.0.1:8000/witaj`, `/test` |
| 01 | 03 | 3 | [Parametry dynamiczne i opcjonalne](lekcje/lekcja_01/temat_03/cwiczenie_03.txt) | `http://127.0.0.1:8000/users/42`, `/photo` |
| 01 | 03 | 4 | [Pojemność prostopadłościanu](lekcje/lekcja_01/temat_03/cwiczenie_04.txt) | `http://127.0.0.1:8000/12/32/321` — **123264 m3** |

[Opis lekcji 01](lekcje/lekcja_01/README.md) · [Temat 01](lekcje/lekcja_01/temat_01/README.md) · [Temat 02](lekcje/lekcja_01/temat_02/README.md) · [Temat 03](lekcje/lekcja_01/temat_03/README.md)

## Lekcja 02 — spis zadań

| Lekcja | Temat | Ćwiczenie | Zadanie / instrukcja | Wynik do pokazania po uruchomieniu |
|---|---|---|---|---|
| 02 | 05 | 5 | [Formularz użytkownika, POST i CSRF](lekcje/lekcja_02/temat_05/cwiczenie_05.txt) | `http://127.0.0.1:8000/userform` — po zatwierdzeniu dane w widoku wynikowym |
| 02 | 06 | 6 | [Walidacja pól formularza](lekcje/lekcja_02/temat_06/cwiczenie_06.txt) | `http://127.0.0.1:8000/userform` — ograniczenia pól i hasła |
| 02 | 07 | 7A | [Dodawanie użytkowników do bazy](lekcje/lekcja_02/temat_07/cwiczenie_07a_uzytkownicy.txt) | `http://127.0.0.1:8000/adduser` — zapis i wynik JSON |
| 02 | 07 | 7B | [Faker i sprawdzanie książek](lekcje/lekcja_02/temat_07/cwiczenie_07b_faker.txt) | `http://127.0.0.1:8000/books`, `/check` |
| 02 | 08 | 8 | [Autoryzacja i panel AdminLTE 3](lekcje/lekcja_02/temat_08/cwiczenie_08.txt) | `/register`, `/login`, `/home`, `/panel/formularz` |
| 02 | 09 | 9A — e24 | [Model Book i lista książek](lekcje/lekcja_02/temat_09/cwiczenie_09a_e24.txt) | `/temat-9/books` — 3 książki |
| 02 | 09 | 9B — e24_v1 | [Formularz i model Test](lekcje/lekcja_02/temat_09/cwiczenie_09b_e24_v1.txt) | `/temat-9/dbTestTableForm`, `/temat-9/ModelTestController` |

[Opis lekcji 02](lekcje/lekcja_02/README.md) · [Temat 05 — Wykorzystanie formularzy](lekcje/lekcja_02/temat_05/README.md) · [Temat 06 — Walidacja danych](lekcje/lekcja_02/temat_06/README.md)

Numeracja tematu 05 jest zgodna z materiałami prowadzącego. Nie przypisano zadań do tematu 04.

[Temat 07 — Połączenie z bazą i migracje](lekcje/lekcja_02/temat_07/README.md). **Aktualny projekt używa MariaDB**, dlatego na uczelni uruchom MySQL w XAMPP i utwórz bazę `project` zgodnie z instrukcją zadania 7A.

## Gdzie jest kod?

[Temat 08 — Autoryzacja](lekcje/lekcja_02/temat_08/README.md): rejestracja i logowanie do panelu AdminLTE 3. Na uczelni utwórz konto przez `/register`; publiczna kopia SQL nie zawiera kont. Zasoby panelu instaluje automatycznie `composer install`.

[Kopia przykładowych danych i instrukcja importu w phpMyAdmin](baza/instrukcja_importu.txt) pozwalają przenieść na uczelnię te same książki i przykładowego użytkownika. Najpierw wykonaj migracje, potem import SQL zamiast zwykłego seedera.

| Lokalizacja w repozytorium | Zastosowanie | Katalog na komputerze |
|---|---|---|
| [pierwszy_skrypt/](pierwszy_skrypt/) | Pierwszy skrypt PHP | `C:\xampp\htdocs\pierwszy_skrypt` |
| [index.php](index.php) w głównym katalogu | Prosty projekt z zadania GitHub | `C:\xampp\htdocs\git\project1` |
| [project_1/](project_1/) | Wspólny projekt Laravel 12: tematy 02, 03, 05, 06, 07, 08 i 09 | `C:\xampp\htdocs\project_1` |
| [xampp/](xampp/) | Instrukcja środowiska | Instalacja XAMPP |
| [lekcje/](lekcje/) | Spis i instrukcje wszystkich zadań | Dokumentacja |

**`project1` i `project_1` to dwa różne projekty:** pierwszy jest prostym PHP, drugi aplikacją Laravel.

## Jak pokazać konkretne zadanie?

Przykład: „Temat 3, ćwiczenie 4”.

1. Otwórz [instrukcję ćwiczenia 4](lekcje/lekcja_01/temat_03/cwiczenie_04.txt).
2. Pobierz i przygotuj Laravel według instrukcji. Jeśli jest już przygotowany, wykonaj w jego folderze `php artisan serve`.
3. Wejdź na `http://127.0.0.1:8000/12/32/321`.
4. Pokaż żółtą stronę z niebieskim wynikiem **123264 m3** i wskazane w instrukcji pliki.

## Pobieranie i zachowane wersje

Aktualne pliki: **Code → Download ZIP**. Do uruchomienia Laravel skopiuj folder `project_1`, następnie wykonaj polecenia z instrukcji ćwiczenia.

- [Wersja z końca lekcji 01](https://github.com/pzx119592/WSB_ZastProg/tree/lekcja-01) · [ZIP lekcji 01](https://github.com/pzx119592/WSB_ZastProg/archive/refs/tags/lekcja-01.zip).
- [Wersja Laravel z końca tematu 02](https://github.com/pzx119592/WSB_ZastProg/tree/bf44c9b/project_1) — przed zmianą strony głównej w temacie 03.

Plik `.env`, biblioteki `vendor` i lokalna baza MariaDB powstają na każdym komputerze zgodnie z instrukcją. Zachowane starsze wersje mogą korzystać z SQLite — stosuj instrukcję właściwą dla pobranej wersji.

## Organizacja następnych zajęć

**Zachowujemy wcześniejsze ćwiczenia na ich etapie:** kolejne zadanie nie zastępuje istniejących adresów, widoków ani tabel. Przy kolizji nazw nowe zadanie dostaje prefiks tematu, np. `/temat-9/books` i `books_temat9`; wcześniejsze `/books` i `books` nadal pokazują temat 7. Każda wersja ćwiczenia otrzymuje osobną instrukcję.

[Temat 09 — Modele](lekcje/lekcja_02/temat_09/README.md) obejmuje e24, a następnie e24_v1. [Osobna kopia SQL tematu 9](baza/instrukcja_importu_temat_09.txt) odtwarza tylko dane tych ćwiczeń.

Każda kolejna lekcja otrzyma folder `lekcje/lekcja_02`, `lekcja_03` itd. W środku znajdą się tematy i osobne instrukcje ćwiczeń. Spis będzie aktualizowany razem z kodem.

Format opisu commita: `Lekcja 02 | Temat 05 | Ćwiczenie 05 — formularz użytkownika`. Commit obejmujący kilka ćwiczeń będzie wskazywał ich zakres.
