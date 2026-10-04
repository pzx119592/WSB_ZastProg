# project_1 — Laravel 12

Projekt z przedmiotu **Programowanie w zastosowaniach**. Laravel Framework 12.69.3, PHP 8.2 lub nowszy.

## Ćwiczenia

- [Lekcja 01, temat 02 — instalacja i struktura Laravel](../lekcje/lekcja_01/temat_02/README.md).
- [Lekcja 01, temat 03 — routing, widoki i kontroler](../lekcje/lekcja_01/temat_03/README.md).
- [Temat 03, ćwiczenie 4 — pojemność prostopadłościanu](../lekcje/lekcja_01/temat_03/cwiczenie_04.txt).
- [Lekcja 02, temat 05 — formularz użytkownika](../lekcje/lekcja_02/temat_05/README.md).
- [Lekcja 02, temat 06 — walidacja danych](../lekcje/lekcja_02/temat_06/README.md).
- [Lekcja 02, temat 07 — dodawanie użytkowników i Faker](../lekcje/lekcja_02/temat_07/README.md).
- [Lekcja 02, temat 08 — autoryzacja i AdminLTE 3](../lekcje/lekcja_02/temat_08/README.md).
- [Lekcja 02, temat 09 — model Book i model Test](../lekcje/lekcja_02/temat_09/README.md).

## Uruchomienie

Pobierz repozytorium i skopiuj ten folder do `C:\xampp\htdocs\project_1`. Wykonaj polecenia z [instrukcja.txt](instrukcja.txt), aby zainstalować zależności i przygotować lokalną konfigurację.

Po przygotowaniu:

```powershell
cd C:\xampp\htdocs\project_1
php artisan serve
```

Otwórz `http://127.0.0.1:8000`. Strona główna ma nawigację do przykładów. Testy: `php artisan test`.

Formularz z ćwiczenia 5: `http://127.0.0.1:8000/userform`. Dane są wysyłane metodą POST do kontrolera `Form`, a wynik jest wyświetlany przez `form.blade.php`.

Projekt używa teraz MariaDB: uruchom MySQL w XAMPP i utwórz bazę `project` przed migracjami. Zobacz [instrukcję bazy](instrukcja_temat_7a.txt). Dodawanie użytkowników: `/adduser`; książki: `/books`; sprawdzanie tytułu: `/check`.

[Główny spis wszystkich zadań](../README.md) · [Zbiorcza instrukcja tematu 03](instrukcja_temat_3.txt).

Rejestracja i logowanie: `/register` i `/login`. Chroniony panel AdminLTE 3: `/home`, formularz: `/panel/formularz`. [Instrukcja tematu 8](instrukcja_temat_8.txt) zawiera pełny scenariusz prezentacji. `composer install` publikuje lokalne zasoby panelu; na uczelni zarejestruj własne konto.

Temat 9 ma osobne adresy: `/temat-9/books` (e24), `/temat-9/dbTestTableForm` i `/temat-9/ModelTestController` (e24_v1). Wykonaj `php artisan migrate` oraz `php artisan db:seed --class=BookSeeder`. [Instrukcja 9A](instrukcja_temat_9a.txt) i [instrukcja 9B](instrukcja_temat_9b.txt) opisują przygotowanie i prezentację. Tabela `books_temat9` jest osobna od `books` z tematu 7, więc starsze zadania działają jak wcześniej.
