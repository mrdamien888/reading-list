<?php

namespace App\Http\Controllers\Api;

use App\Models\APIBook;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    private $books;
    // private $isbn;

   
     /*    public function setIsbn($isbn) 
        {
            $json = Http::get('https://openlibrary.org/api/books?bibkeys=' . $isbn . '&jscmd=data&format=json')
            ->json();

            $this->isbn  = $isbn;
            $this->books = collect($json)
                ->map(function($item) {
                    return collect($item)->only(['title', 'authors', 'number_of_pages'])
                        ->collect();
                });
        }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = APIBook::all();
        $bookList = BookResource::collection($books);

        return $bookList;
    }

    public function order()
    {
        $books = APIBook::all();
        $orderedBooks = BookResource::collection($books)->reverse()->values();

        return $orderedBooks;
    }

    public function sort()
    {
        $books = APIBook::all();
        $sortedBooks = BookResource::collection($books)->sort()->values();

        return $sortedBooks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newBook = new APIBook;
        $newBook->title    = $request->book['title'];
        $newBook->author   = $request->book['author'];
        $newBook->pages    = $request->book['pages'];

        if ($newBook->save()) {
            return new BookResource($newBook);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $existingBook = APIBook::findOrFail($id);

        $book = new BookResource($existingBook);

        return view('details', [
            'book' => $book
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingBook = APIBook::findOrFail($id);

        if ($existingBook->delete()) {
            return new BookResource($existingBook);
        }
    }
}