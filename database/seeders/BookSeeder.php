<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $data = [
        [
            'title' => 'The Clay Machine-Gun',
            'author' => 'Victor Pelevin',
            'publication_year' => '2005',
            'publisher' => 'Faber & Faber',
            'isbn' => '978-0-5712-0126-6',
        ],
        [
            'title' => 'The Collector',
            'author' => 'John Fowles',
            'publication_year' => '1990',
            'publisher' => 'Little, Brown and Company',
            'isbn' => '978-0-9650-5848-3',
        ],
        [
            'title' => 'The Republic',
            'author' => 'Plato',
            'publication_year' => '2007',
            'publisher' => 'Penguin Classics; New edition',
            'isbn' => '978-0-1404-5511-3',
        ],
        [
            'title' => 'Thus Spoke Zarathustra',
            'author' => 'Friedrich Nietzsche',
            'publication_year' => '1974',
            'publisher' => 'Penguin Classics',
            'isbn' => '978-0-1404-4118-5',
        ],
        [
            'title' => 'Nausea',
            'author' => 'Jean-Paule Sartre',
            'publication_year' => '2013',
            'publisher' => 'New Directions; Reprint edition',
            'isbn' => '978-0-8112-2030-9',
        ],
        [
            'title' => 'The Picture of Dorian Gray',
            'author' => 'Oscar Wilde',
            'publication_year' => '1992',
            'publisher' => 'Wordsworth Editions',
            'isbn' => '978-1-8532-6015-5',
        ]
        ];

    public function run()
    {
        DB::table('books')->insert($this->data);
    }
}
