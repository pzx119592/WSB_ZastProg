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
            'password' => 'Haslo123!',
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
            ->assertDontSee('Haslo123!');
    }

    public function test_empty_fields_return_polish_errors_and_keep_non_secret_input(): void
    {
        $this->from('/userform')->post('/form', ['email' => 'anna@example.com'])
            ->assertRedirect('/userform')
            ->assertSessionHasErrors([
                'password' => 'Podaj hasło.',
                'gender' => 'Wybierz płeć.',
            ])->assertSessionHasInput('email', 'anna@example.com');
    }

    public function test_invalid_email_short_password_and_unknown_gender_are_rejected(): void
    {
        $this->from('/userform')->post('/form', [
            'name' => 'A', 'email' => 'nie-email', 'password' => '123', 'gender' => 'other',
        ])->assertRedirect('/userform')->assertSessionHasErrors([
            'name' => 'Imię musi mieć co najmniej 3 znaki.',
            'email' => 'Podaj poprawny adres e-mail.',
            'password' => 'Hasło musi mieć co najmniej 8 znaków.',
            'gender' => 'Wybierz jedną z dostępnych opcji płci.',
        ])->assertSessionMissing('_old_input.password');
    }

    public function test_long_name_is_rejected_and_result_escapes_html(): void
    {
        $data = $this->exampleData();
        $data['name'] = str_repeat('A', 21);
        $this->post('/form', $data)->assertSessionHasErrors('name');
        $data['name'] = '<b>Anna</b>';
        $this->post('/form', $data)->assertOk()
            ->assertSee('&lt;b&gt;Anna&lt;/b&gt;', false)->assertDontSee('<b>Anna</b>', false);
    }

    public function test_result_endpoint_does_not_accept_get(): void
    {
        $this->get('/form')->assertStatus(405);
    }

    public function test_name_is_optional_and_valid_boundaries_are_accepted(): void
    {
        $data = $this->exampleData();
        unset($data['name']);
        $this->post('/form', $data)->assertOk()->assertSee('Nie podano');
        $data['name'] = '';
        $this->post('/form', $data)->assertOk()->assertSee('Nie podano');
        $data['name'] = 'Jan';
        $data['password'] = 'Abcdef1!';
        $this->post('/form', $data)->assertOk();
        $data['name'] = str_repeat('A', 20);
        $data['email'] = str_repeat('a', 8).'@example.com';
        $data['password'] = 'Ab1!'.str_repeat('a', 26);
        $this->post('/form', $data)->assertOk();
    }

    public function test_email_is_required_and_respects_length_limits(): void
    {
        $data = $this->exampleData();
        foreach ([null, 'ab', str_repeat('a', 9).'@example.com'] as $email) {
            $data['email'] = $email;
            $this->post('/form', $data)->assertSessionHasErrors('email');
        }
    }

    public function test_password_requires_all_character_groups_and_length_limits(): void
    {
        $data = $this->exampleData();
        foreach (['Abcde1!', 'Ab1!'.str_repeat('a', 27), 'HASLO123!', 'haslo123!', 'Hasloabc!', 'Haslo1234', 'Haslo123 '] as $password) {
            $data['password'] = $password;
            $this->post('/form', $data)->assertSessionHasErrors('password');
        }
    }

    public function test_multiple_gender_values_cannot_be_submitted(): void
    {
        $data = $this->exampleData();
        $data['gender'] = ['male', 'female'];
        $this->post('/form', $data)->assertSessionHasErrors('gender');
    }
}
