<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titleToCheck = $this->command && $this->command->getDefinition()->hasOption('check')
            ? $this->command->option('check') : null;
        if ($titleToCheck !== null) {
            $this->check_book_title($titleToCheck);
            return;
        }
        // Stała książka pozwala odtworzyć przykład --check z zadania.
        if (! DB::table('books')->where('title', 'The Catcher in the Rye')->exists()) {
            $this->insertBook('The Catcher in the Rye', 'J. D. Salinger');
        }
        $faker = Factory::create('pl_PL');
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->unique()->sentence(4);
            if (! DB::table('books')->where('title', $title)->exists()) {
                $this->insertBook($title, $faker->name());
            }
        }
    }

    public function check_book_title(string $title): bool
    {
        $book = DB::table('books')->where('title', $title)->first();
        // Cache bazy łączy sprawdzanie w terminalu z widokiem /check.
        Cache::forever('books.check.title', $title);
        if ($book === null) {
            return false;
        }
        $this->command?->error('Błąd: książka „'.$book->title.'” już istnieje w tabeli books.');
        $this->command?->line(rtrim(config('app.url'), '/').'/books#book-'.$book->id);
        return true;
    }

    private function insertBook(string $title, string $author): void
    {
        DB::table('books')->insert([
            'title' => $title, 'author' => $author,
            'created_at' => now(), 'updated_at' => now(),
        ]);
    }
}
