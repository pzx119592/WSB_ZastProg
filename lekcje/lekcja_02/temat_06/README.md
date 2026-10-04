# Lekcja 02 — Temat 06: Walidacja danych

[Spis lekcji](../README.md) · [Główny spis zadań](../../../README.md)

| Ćwiczenie | Zadanie i instrukcja | Kod |
|---|---|---|
| 6 | [Walidacja formularza użytkownika](cwiczenie_06.txt) | [Form.php](../../../project_1/app/Http/Controllers/Form.php), [userform.blade.php](../../../project_1/resources/views/userform.blade.php), [form.blade.php](../../../project_1/resources/views/form.blade.php) |

Ćwiczenie rozszerza formularz z tematu 05. Adres po uruchomieniu: `http://127.0.0.1:8000/userform`.

| Pole | Wymagane | Zasady |
|---|---|---|
| Imię (`text`) | Nie | 3–20 znaków, jeśli podano |
| E-mail (`email`) | Tak | 3–20 znaków i poprawny adres |
| Hasło (`password`) | Tak | 8–30 znaków, mała i duża litera, cyfra i znak specjalny |
| Płeć (`radio`) | Tak | Jedna opcja: Mężczyzna albo Kobieta |

Ograniczenia są sprawdzane przez przeglądarkę i ponownie przez kontroler. Puste imię jest poprawne; wynik pokazuje „Nie podano”. Komunikaty walidacji serwera są po polsku.
