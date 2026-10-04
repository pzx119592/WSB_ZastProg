<?php

namespace Database\Seeders;

use App\Models\Book;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ['title' => 'Ogniem i mieczem', 'year' => 1884, 'price' => '49.90', 'pages' => 592],
            ['title' => 'Potop', 'year' => 1886, 'price' => '59.90', 'pages' => 936],
            ['title' => 'Pan Wołodyjowski', 'year' => 1888, 'price' => '39.90', 'pages' => 416],
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(['title' => $book['title']], $book + [
                'publication_place' => 'Warszawa',
            ]);
        }
    }
}
