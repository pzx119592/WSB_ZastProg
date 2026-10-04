# project_1 — Laravel 12

Projekt z przedmiotu **Programowanie w zastosowaniach**. Laravel Framework 12.69.3, PHP 8.2 lub nowszy.

## Ćwiczenia

- [Lekcja 01, temat 02 — instalacja i struktura Laravel](../lekcje/lekcja_01/temat_02/README.md).
- [Lekcja 01, temat 03 — routing, widoki i kontroler](../lekcje/lekcja_01/temat_03/README.md).
- [Temat 03, ćwiczenie 4 — pojemność prostopadłościanu](../lekcje/lekcja_01/temat_03/cwiczenie_04.txt).
- [Lekcja 02, temat 05 — formularz użytkownika](../lekcje/lekcja_02/temat_05/README.md).

## Uruchomienie

Pobierz repozytorium i skopiuj ten folder do `C:\xampp\htdocs\project_1`. Wykonaj polecenia z [instrukcja.txt](instrukcja.txt), aby zainstalować zależności i przygotować lokalną konfigurację.

Po przygotowaniu:

```powershell
cd C:\xampp\htdocs\project_1
php artisan serve
```

Otwórz `http://127.0.0.1:8000`. Strona główna ma nawigację do przykładów. Testy: `php artisan test`.

Formularz z ćwiczenia 5: `http://127.0.0.1:8000/userform`. Dane są wysyłane metodą POST do kontrolera `Form`, a wynik jest wyświetlany przez `form.blade.php`.

[Główny spis wszystkich zadań](../README.md) · [Zbiorcza instrukcja tematu 03](instrukcja_temat_3.txt).
