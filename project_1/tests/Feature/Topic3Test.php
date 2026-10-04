<?php

namespace Tests\Feature;

use Tests\TestCase;

class Topic3Test extends TestCase
{
    public function test_homepage_renders_the_custom_view_with_navigation_and_styles(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertViewIs('strona_glowna')
            ->assertSee('Witaj na mojej stronie!')
            ->assertSee('/css/style.css')
            ->assertSee('/12/32/321');
    }

    public function test_closure_and_controller_return_the_requested_greeting(): void
    {
        $this->get('/witaj')->assertOk()->assertContent('Witaj w aplikacji!');
        $this->get('/test')->assertOk()->assertContent('Witaj w aplikacji!');
    }

    public function test_user_identifier_is_displayed_safely(): void
    {
        $this->get('/users/42')->assertOk()->assertContent('Identyfikator użytkownika: 42');
        $this->get('/users/'.rawurlencode('<img onerror=alert(1)>'))
            ->assertOk()
            ->assertContent('Identyfikator użytkownika: &lt;img onerror=alert(1)&gt;');
    }

    public function test_photo_supports_both_optional_parameters(): void
    {
        $this->get('/photo/Krakow/Dluga')
            ->assertOk()
            ->assertSee('To jest zdjęcie z Krakow zrobione na ulicy Dluga.');
        $this->get('/photo/Krakow')
            ->assertOk()
            ->assertSee('To jest zdjęcie z Krakow zrobione na ulicy main.');
        $this->get('/photo')
            ->assertOk()
            ->assertSee('To jest zdjęcie bez podanego miasta zrobione na ulicy main.');
    }

    public function test_photo_escapes_html_from_the_url(): void
    {
        $this->get('/photo/'.rawurlencode('<img onerror=alert(1)>'))
            ->assertOk()
            ->assertSee('&lt;img onerror=alert(1)&gt;', false)
            ->assertDontSee('<img onerror=alert(1)>', false);
    }

    public function test_volume_is_calculated_and_passed_to_the_view(): void
    {
        $this->get('/12/32/321')
            ->assertOk()
            ->assertViewIs('pojemnosc')
            ->assertSee('Prostopadłościan o wymiarach 12 × 32 × 321 ma pojemność 123264 m3.')
            ->assertSee('class="volume-page"', false);
        $this->get('/1.5/2/3')->assertOk()->assertSee('ma pojemność 9 m3.');
    }

    public function test_volume_route_rejects_non_numeric_dimensions(): void
    {
        $this->get('/abc/32/321')->assertNotFound();
    }
}
