<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Test as TestRecord;
use Database\Seeders\BookSeeder;
use Database\Seeders\BooksTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ModelsExercisesTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_model_seeder_adds_three_complete_records_without_duplicates(): void
    {
        $this->seed(BookSeeder::class);
        $this->seed(BookSeeder::class);
        $this->assertDatabaseCount('books_temat9', 3);
        $book = Book::where('title', 'Ogniem i mieczem')->firstOrFail();
        $this->assertSame(1884, $book->year);
        $this->assertSame('49.90', $book->price);
        $this->assertSame(592, $book->pages);
        $this->assertSame('Warszawa', $book->publication_place);
        $this->assertNotNull($book->created_at);
        $this->get('/temat-9/books')->assertOk()->assertViewIs('book.list')
            ->assertSee('Lista książek')->assertSee('Tytuł: Ogniem i mieczem')
            ->assertSee('Tytuł: Potop')->assertSee('Tytuł: Pan Wołodyjowski');
    }

    public function test_previous_books_exercise_keeps_its_route_and_data(): void
    {
        $this->seed(BooksTableSeeder::class);
        $previousBooks = DB::table('books')->orderBy('id')->get()->toJson();
        $this->seed(BookSeeder::class);
        $this->assertSame($previousBooks, DB::table('books')->orderBy('id')->get()->toJson());
        $this->assertDatabaseCount('books', 11);
        $this->get('/books')->assertOk()->assertViewIs('books')->assertSee('The Catcher in the Rye')
            ->assertDontSee('Ogniem i mieczem');
        $this->get('/temat-9/books')->assertDontSee('The Catcher in the Rye');
    }

    public function test_form_saves_all_fields_through_model_and_lists_all_records(): void
    {
        $this->get('/temat-9/dbTestTableForm')->assertOk()->assertSee('Dodaj użytkownika')
            ->assertSee('name="_token"', false)->assertSee('name="height"', false);
        $data = $this->personData();
        $this->post('/temat-9/dbTestTableForm', $data)->assertRedirect('/temat-9/ModelTestController');
        // SQLite przechowuje datę z czasem, MariaDB normalizuje ją do kolumny DATE.
        $this->assertDatabaseHas('tests', array_diff_key($data, ['birthday' => true]));
        $record = TestRecord::firstOrFail();
        $this->assertSame('2022-03-26', $record->birthday->format('Y-m-d'));
        $this->assertSame('72.00', $record->height);
        $this->assertNotNull($record->created_at);
        $this->assertNotNull($record->updated_at);
        TestRecord::create(array_replace($data, ['name' => 'Anna', 'email' => 'anna@example.test']));
        $this->get('/temat-9/ModelTestController')->assertOk()->assertViewIs('test.list')
            ->assertSee('Imię i nazwisko: Franciszek Nowak, email: franciszek@example.test')
            ->assertSee('Imię i nazwisko: Anna Nowak, email: anna@example.test')
            ->assertSee('72.00 cm')->assertSee('2022-03-26');
        $this->assertDatabaseCount('users', 0);
        $this->assertDatabaseCount('user', 0);
    }

    public function test_invalid_data_cannot_be_inserted_and_form_keeps_old_values(): void
    {
        $this->from('/temat-9/dbTestTableForm')->post('/temat-9/dbTestTableForm', [
            'name' => 'Franciszek', 'surname' => '', 'email' => 'nie-email',
            'birthday' => now()->addDay()->format('Y-m-d'), 'height' => '-1',
        ])->assertRedirect('/temat-9/dbTestTableForm')
            ->assertSessionHasErrors(['surname', 'email', 'birthday', 'height']);
        $this->assertDatabaseCount('tests', 0);
        $this->get('/temat-9/dbTestTableForm')->assertSee('value="Franciszek"', false);
    }

    public function test_lists_escape_html_from_models(): void
    {
        TestRecord::create(array_replace($this->personData(), ['name' => '<script>alert(1)</script>']));
        $this->get('/temat-9/ModelTestController')->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
        $this->seed(BookSeeder::class);
        Book::first()->update(['title' => '<b>Tytuł</b>']);
        $this->get('/temat-9/books')->assertOk()->assertSee('&lt;b&gt;Tytuł&lt;/b&gt;', false)
            ->assertDontSee('<b>Tytuł</b>', false);
    }

    public function test_empty_lists_and_csrf_protection_work(): void
    {
        $this->get('/temat-9/books')->assertOk()->assertSee('Brak książek');
        $this->get('/temat-9/ModelTestController')->assertOk()->assertSee('Brak użytkowników');
        $this->app->instance('env', 'local');
        $this->post('/temat-9/dbTestTableForm', $this->personData())->assertStatus(419);
        $this->assertDatabaseCount('tests', 0);
    }

    private function personData(): array
    {
        return [
            'name' => 'Franciszek', 'surname' => 'Nowak', 'email' => 'franciszek@example.test',
            'birthday' => '2022-03-26', 'height' => '72.00',
        ];
    }
}
