<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Console\Command;

class TestOneToMany extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-one-to-many';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // creation using the create method
        $author = Author::create([
            'name' => 'J.R.R. Tolkien'
        ]);

        $book = Book::create([
            'title' => 'The Lord of the Rings',
            'author_id' => $author->id // Use the author's ID
        ]);

        // creation using laravel models (preferred)

        $author = new Author(['name' => 'Dani']);
        $author->save();
        $book1 = new Book(['title' => 'First book']);
        $book2 = new Book(['title' => 'Second book']);

        $author->books()->save($book1);

        $book2->author()->associate($author);
        $book2->save();

        // getting the data

//        var_dump(Author::all());

        $author = Author::find(2);
        var_dump($author->name);
        var_dump($author->books[0]->title);

        $book = Book::take(1)->first();

        var_dump($book->title);
        var_dump($book->author->name);
    }
}
