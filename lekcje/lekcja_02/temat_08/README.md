# Lekcja 02 — Temat 08: Autoryzacja

[Instrukcja uruchomienia i adresy do pokazania](cwiczenie_08.txt) · [Spis lekcji](../README.md) · [Główny spis zadań](../../../README.md)

Ćwiczenie obejmuje opis tematu oraz wymagania z `ex8.pdf`: rejestrację i logowanie z bazą `users`, panel **AdminLTE 3**, logo WSB, rozwijane menu **Logout**, uproszczony panel boczny z pozycją **Formularz**, pola `name`/`surname` i wynik POST `Imię i nazwisko: … …`.

| Adres | Wynik |
|---|---|
| `/register` | Nowe konto w tabeli `users`; po rejestracji przejście do logowania |
| `/login` | Logowanie przy użyciu e-maila i hasła |
| `/home` | Panel dostępny wyłącznie po zalogowaniu |
| `/panel/formularz` | Formularz i odpowiedź na POST |
| POST `/logout` | Wylogowanie, unieważnienie sesji i powrót do logowania |

PDF pochodzi ze starszej wersji zajęć i wskazuje Laravel 7. Zadanie dodano do wspólnego `project_1` w **Laravel 12**, zgodnie z wersją używaną na zajęciach. AdminLTE pozostaje w wymaganej wersji **3.2.0**. Nie trzeba od nowa tworzyć projektu ani migrować do Laravel 7.

Hasła są hashowane przez istniejący [model User](../../../project_1/app/Models/User.php). [AuthController](../../../project_1/app/Http/Controllers/AuthController.php) korzysta z mechanizmów Laravel; formularze mają CSRF, a panel middleware `auth`. Rejestracja i logowanie mają ograniczenie częstotliwości żądań. Widoki Blade escapują dane użytkownika.

`composer install` pobiera integrację AdminLTE oraz automatycznie publikuje zasoby do `public/vendor`. Ten katalog jest generowany lokalnie. Po instalacji działanie panelu nie wymaga CDN ani Node.js. Logo zapisano lokalnie; jego źródło opisano w [public/images/README.txt](../../../project_1/public/images/README.txt).

Kopia danych z tematu 7 pozostaje aktualna dla tabel `user` i `books`. **Kont logowania nie ma w publicznej kopii SQL** — na uczelni zarejestruj własne konto.

Dokumentacja: [uwierzytelnianie Laravel 12](https://laravel.com/docs/12.x/authentication), [instalacja integracji AdminLTE 3](https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Installation).
