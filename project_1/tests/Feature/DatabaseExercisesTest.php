<?php

namespace Tests\Feature;

use Database\Seeders\BooksTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class DatabaseExercisesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_form_and_database_insert_match_the_pdf(): void
    {
        $this->get('/adduser')->assertOk()->assertViewIs('adduser')
            ->assertSee('name="surname"', false)->assertSee('type="date"', false)
            ->assertSee('name="_token"', false);
        $data = ['name' => 'Anna', 'surname' => 'Nowak', 'birthday' => '1999-02-22'];
        $this->post('/User', $data)->assertOk()->assertJsonFragment($data);
        $this->assertDatabaseHas('user', $data);
        $this->assertNotNull(DB::table('user')->value('create_user'));
        $this->get('/user-records')->assertOk()->assertSee('Anna')->assertSee('Nowak')->assertSee('1999-02-22');
    }

    public function test_invalid_user_data_cannot_create_a_record(): void
    {
        $this->from('/adduser')->post('/User', [
            'name' => '', 'surname' => '', 'birthday' => now()->addDay()->toDateString(),
        ])->assertRedirect('/adduser')->assertSessionHasErrors(['name', 'surname', 'birthday']);
        $this->assertDatabaseCount('user', 0);
    }

    public function test_faker_seeds_books_and_rerunning_does_not_duplicate_the_reference_title(): void
    {
        $this->seed(BooksTableSeeder::class);
        $this->assertDatabaseCount('books', 11);
        $this->assertDatabaseHas('books', ['title' => 'The Catcher in the Rye', 'author' => 'J. D. Salinger']);
        $this->get('/books')->assertOk()->assertViewIs('books')->assertSee('The Catcher in the Rye');
        $this->seed(BooksTableSeeder::class);
        $this->assertSame(1, DB::table('books')->where('title', 'The Catcher in the Rye')->count());
        $this->assertSame(DB::table('books')->count(), DB::table('books')->distinct()->count('title'));
    }

    public function test_requested_artisan_option_checks_without_inserting_and_links_to_the_book(): void
    {
        $this->seed(BooksTableSeeder::class);
        $this->artisan('db:seed', ['--class' => 'BooksTableSeeder', '--check' => 'The Catcher in the Rye'])
            ->expectsOutput('Błąd: książka „The Catcher in the Rye” już istnieje w tabeli books.')
            ->assertExitCode(0);
        $this->assertDatabaseCount('books', 11);
        $this->assertSame('The Catcher in the Rye', Cache::get('books.check.title'));
        $id = DB::table('books')->where('title', 'The Catcher in the Rye')->value('id');
        $this->get('/check')->assertOk()->assertSee('już istnieje')->assertSee('#book-'.$id);
    }

    public function test_missing_title_produces_no_duplicate_error(): void
    {
        $this->seed(BooksTableSeeder::class);
        $this->artisan('db:seed', ['--class' => 'BooksTableSeeder', '--check' => 'Nieistniejący tytuł'])
            ->assertExitCode(0);
        $this->assertDatabaseCount('books', 11);
        $this->get('/check')->assertOk()->assertDontSee('już istnieje');
    }

    public function test_titles_are_escaped_in_the_table_and_check_view(): void
    {
        DB::table('books')->insert(['title' => '<b>Książka</b>', 'author' => '<b>Autor</b>']);
        $this->get('/books')->assertOk()->assertSee('&lt;b&gt;Książka&lt;/b&gt;', false)
            ->assertDontSee('<b>Książka</b>', false);
        Cache::forever('books.check.title', '<b>Książka</b>');
        $this->get('/check')->assertOk()->assertSee('&lt;b&gt;Książka&lt;/b&gt;', false)
            ->assertDontSee('<b>Książka</b>', false);
    }
}
