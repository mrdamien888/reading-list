<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $books = Book::select('id', 'title', 'author')
                    ->where('user_id', auth()->user()->id)
                    ->orderBy('position')
                    ->get();

        return view('books.index', [
            'books' => $books
        ]);
    }

    public function sort(Request $request) 
    {
        $sortByArray = explode(' ', $request->sortby);

        if (!in_array('position', $sortByArray)) {
            $column = $sortByArray[0];
            $direct = $sortByArray[1];

            $books = Book::select('id', 'title', 'author')
                        ->where('user_id', auth()->user()->id)
                        ->orderBy($column, $direct)
                        ->get();

            return $books;
            
        } else {
            $books = Book::select('id', 'title', 'author')
                        ->where('user_id', auth()->user()->id)
                        ->orderBy('position')
                        ->get();
            return $books;
        }
    }

    public function show($id)
    {
        $book = Book::where('user_id', auth()->user()->id)
                    ->where('id', '=', $id)
                    ->findOrFail($id);

        return view('books.show', [
            'book' => $book
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'author'   => 'required|max:255',
            'title'    => 'required|unique:books,title,NULL,id,user_id,'.Auth::user()->id.'|max:255',
            'overview' => 'required',
            'pub_date' => 'required|date_format:Y-m-d',
            'pages'    => 'required|integer'
        ]);

        $position = Book::where('user_id', auth()->user()->id)->max('position') + 1;
        
        $request->user()->books()->create([
            'author'   => $request->author,
            'title'    => $request->title,
            'overview' => $request->overview,
            'pub_date' => $request->pub_date,
            'pages'    => $request->pages,
            'position' => $position          
        ]);            

        return redirect('/books')->with('book_added', 'Your book has been added!');
    }

    public function update(Request $request)
    {
        $books = Book::where('user_id', auth()->user()->id)->get();

        foreach ($books as $book) {
            foreach ($request->order as $order) {
                if ($order['book_id'] == $book->id) {
                    $book->update(['position' => $order['position']]);
                }
            }
        }

        return response('Update Successful.', 200);
    }

    public function destroy(Book $book)
    {
       $this->authorize('delete', $book);

       $book->delete();

       return redirect('/books')->with('book_deleted', 'Your book was deleted!');
    }
}