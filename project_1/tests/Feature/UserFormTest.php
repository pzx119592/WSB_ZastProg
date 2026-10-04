<?php

namespace Tests\Feature;

use Tests\TestCase;

class UserFormTest extends TestCase
{
    private function exampleData(): array
    {
        return [
            'name' => 'Anna',
            'email' => 'anna@example.com',
            'password' => 'haslo123',
            'gender' => 'female',
        ];
    }

    public function test_form_contains_post_action_csrf_and_required_fields(): void
    {
        $this->get('/userform')->assertOk()->assertViewIs('userform')
            ->assertSee('method="POST"', false)
            ->assertSee('name="_token"', false)
            ->assertSee('Podaj swoje imię')
            ->assertSee('Podaj swój adres @')
            ->assertSee('type="password"', false)
            ->assertSee('Mężczyzna')->assertSee('Kobieta');
    }

    public function test_valid_post_passes_an_array_to_the_result_view(): void
    {
        $data = $this->exampleData();
        $this->post('/form', $data)->assertOk()->assertViewIs('form')
            ->assertViewHas('data', $data)
            ->assertSee('Anna')->assertSee('anna@example.com')->assertSee('Kobieta')
            ->assertDontSee('haslo123');
    }

    public function test_empty_fields_return_polish_errors_and_keep_non_secret_input(): void
    {
        $this->from('/userform')->post('/form', ['email' => 'anna@example.com'])
            ->assertRedirect('/userform')
            ->assertSessionHasErrors([
                'name' => 'Podaj swoje imię.',
                'password' => 'Podaj hasło.',
                'gender' => 'Wybierz płeć.',
            ])->assertSessionHasInput('email', 'anna@example.com');
    }

    public function test_invalid_email_short_password_and_unknown_gender_are_rejected(): void
    {
        $this->from('/userform')->post('/form', [
            'name' => 'A', 'email' => 'nie-email', 'password' => '123', 'gender' => 'other',
        ])->assertRedirect('/userform')->assertSessionHasErrors([
            'name' => 'Imię musi mieć co najmniej 2 znaki.',
            'email' => 'Podaj poprawny adres e-mail.',
            'password' => 'Hasło musi mieć co najmniej 5 znaków.',
            'gender' => 'Wybierz jedną z dostępnych opcji płci.',
        ])->assertSessionMissing('_old_input.password');
    }

    public function test_long_name_is_rejected_and_result_escapes_html(): void
    {
        $data = $this->exampleData();
        $data['name'] = str_repeat('A', 101);
        $this->post('/form', $data)->assertSessionHasErrors('name');
        $data['name'] = '<b>Anna</b>';
        $this->post('/form', $data)->assertOk()
            ->assertSee('&lt;b&gt;Anna&lt;/b&gt;', false)->assertDontSee('<b>Anna</b>', false);
    }

    public function test_result_endpoint_does_not_accept_get(): void
    {
        $this->get('/form')->assertStatus(405);
    }
}
