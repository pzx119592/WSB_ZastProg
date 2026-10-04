# Lekcja 02 — Temat 05: Wykorzystanie formularzy

[Spis lekcji](../README.md) · [Główny spis zadań](../../../README.md)

| Ćwiczenie | Zadanie i instrukcja | Kod |
|---|---|---|
| 5 | [Formularz użytkownika, POST, CSRF i wynik](cwiczenie_05.txt) | [userform.blade.php](../../../project_1/resources/views/userform.blade.php), [Form.php](../../../project_1/app/Http/Controllers/Form.php), [form.blade.php](../../../project_1/resources/views/form.blade.php), [routes/web.php](../../../project_1/routes/web.php) |

Po uruchomieniu Laravel otwórz `http://127.0.0.1:8000/userform` i wypełnij formularz. Zatwierdzenie wysyła dane metodą POST do kontrolera `Form`, który przekazuje tablicę do widoku `form.blade.php`.

Pola: imię, e-mail, hasło oraz wybór Mężczyzna/Kobieta. Formularz zawiera token CSRF, walidację po stronie przeglądarki i serwera oraz polskie komunikaty błędów. Hasło jest zamaskowane na stronie wyniku.

Aktualny formularz ma już reguły z [ćwiczenia 6](../temat_06/README.md). [Wersja sprzed ćwiczenia 6](https://github.com/pzx119592/WSB_ZastProg/tree/ac9bdd8/project_1) zachowuje pierwotne rozwiązanie ćwiczenia 5.
