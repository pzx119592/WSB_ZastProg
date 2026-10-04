<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorizationExercisesTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_hashes_password_and_requires_separate_login(): void
    {
        $this->get('/register')->assertOk()->assertSee('name="_token"', false);
        $this->post('/register', $this->registrationData())->assertRedirect('/login');
        $user = User::where('email', 'student@example.test')->firstOrFail();
        $this->assertTrue(Hash::check('Testowe123!', $user->password));
        $this->assertNotSame('Testowe123!', $user->password);
        $this->assertGuest();
        $this->assertDatabaseCount('users', 1);
        $this->assertDatabaseCount('user', 0);
    }

    public function test_duplicate_email_and_unconfirmed_password_cannot_create_accounts(): void
    {
        User::factory()->create(['email' => 'student@example.test']);
        $this->post('/register', $this->registrationData())
            ->assertSessionHasErrors('email');
        $this->post('/register', array_replace($this->registrationData(), [
            'email' => 'other@example.test', 'password_confirmation' => 'InneHaslo123!',
        ]))->assertSessionHasErrors('password');
        $this->assertDatabaseCount('users', 1);
    }

    public function test_guests_cannot_open_panel_or_send_its_form(): void
    {
        $this->get('/home')->assertRedirect('/login');
        $this->get('/panel/formularz')->assertRedirect('/login');
        $this->post('/panel/formularz', ['name' => 'Anna', 'surname' => 'Nowak'])
            ->assertRedirect('/login');
    }

    public function test_new_account_can_login_and_use_post_form_in_adminlte(): void
    {
        $this->post('/register', $this->registrationData());
        $this->post('/login', ['email' => 'student@example.test', 'password' => 'Testowe123!'])
            ->assertRedirect('/home');
        $this->assertAuthenticatedAs(User::first());
        $this->get('/home')->assertOk()->assertSee('Anna Nowak')->assertSee('wsb-merito.svg')
            ->assertSee('adminlte.min.css')->assertSee('Logout')->assertDontSee('Dashboard v3');
        $this->get('/panel/formularz')->assertOk()->assertSee('name="surname"', false);
        $this->post('/panel/formularz', ['name' => 'Jan', 'surname' => 'Kowalski'])
            ->assertOk()->assertSee('Imię i nazwisko: Jan Kowalski');
    }

    public function test_wrong_password_fails_without_flashing_password(): void
    {
        $this->post('/register', $this->registrationData());
        $this->from('/login')->post('/login', [
            'email' => 'student@example.test', 'password' => 'ZleHaslo123!',
        ])->assertRedirect('/login')->assertSessionHasErrors('email');
        $this->assertGuest();
        $this->assertNull(session()->getOldInput('password'));
    }

    public function test_logout_clears_session_and_protected_page_is_inaccessible(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->withSession(['private_marker' => 'secret']);
        $oldToken = session()->token();
        $this->post('/logout')->assertRedirect('/login');
        $this->assertGuest();
        $this->assertFalse(session()->has('private_marker'));
        $this->assertNotSame($oldToken, session()->token());
        $this->get('/home')->assertRedirect('/login');
        $this->get('/logout')->assertStatus(405);
    }

    public function test_form_errors_and_html_values_are_handled_safely(): void
    {
        $this->actingAs(User::factory()->create());
        $this->post('/panel/formularz', ['name' => '', 'surname' => ''])
            ->assertSessionHasErrors(['name', 'surname']);
        $this->post('/panel/formularz', ['name' => '<script>alert(1)</script>', 'surname' => 'Nowak'])
            ->assertOk()->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_authentication_posts_require_csrf_token(): void
    {
        // Laravel zwykle pomija CSRF podczas testów; tu włączamy realne sprawdzanie.
        $this->app->instance('env', 'local');
        $this->post('/register', $this->registrationData())->assertStatus(419);
        $this->post('/login', ['email' => 'student@example.test', 'password' => 'Testowe123!'])
            ->assertStatus(419);
        $this->actingAs(User::factory()->create())->post('/logout')->assertStatus(419);
    }

    private function registrationData(): array
    {
        return [
            'name' => 'Anna Nowak', 'email' => 'student@example.test',
            'password' => 'Testowe123!', 'password_confirmation' => 'Testowe123!',
        ];
    }
}
