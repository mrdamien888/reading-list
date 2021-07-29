@extends('layouts.app')

@section('framework-styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')
<div id="wrap" class="relative justify-center">
    <div id="add_book_form" class="sticky left-7 max-w-md shadow-md md:max-w-2xl bg-white p-6 rounded-lg">
        @auth
            <h2 class="text-4xl mb-5">Add Book</h2>

            <form action="{{ route('books') }}" method="post">
                @csrf

                <div class="mb-4">
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter the title here" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('title') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ old('title') }}">
                </div>

                <div class="mb-4">
                    @error('author')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror    

                    <label for="author">Author</label>
                    <input type="text" name="author" id="author" placeholder="Enter the author here"  class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('author') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ old('author') }}">
                </div>

                <div class="mb-4">
                    <label for="overview">Overview</label>
                    <textarea name="overview" id="overview" cols="30" rows="4" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('overview') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" placeholder="Enter the overview here"></textarea>

                    @error('overview')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    @error('pub_date')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror     

                    <label for="pub_date">Publication Date</label>
                    <input type="date" name="pub_date" id="pub_date" placeholder="Publication Date" class="max-w-md bg-gray-100 border-2 block p-4 rounded-lg @error('pub_date') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ old('pub_date') }}">
                </div>

                <div class="mb-4">
                    @error('pages')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror    

                    <label for="pages">Pages</label>
                    <input type="text" name="pages" id="pages" pattern="\d*" maxlength="4" class="bg-gray-100 border-2 w-2/12 block p-4 rounded-lg @error('pages') border-red-500 @enderror focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" value="{{ old('pages') }}">
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium hover:bg-green-500">Submit</button>
                    @if(session('book_added'))
                        <span class="text-green-500 text-lg ml-3">{{ session('book_added') }}</span>
                    @elseif(session('book_deleted'))
                        <span class="text-red-500 text-lg ml-3">{{ session('book_deleted') }}</span>
                    @endif
                </div>
            </form>
        @endauth
    </div>

    <div id="book_list_wrapper" class="p-7 shadow-md rounded-lg overflow-hidden bg-gradient-to-r from-light-blue-50 to-light-blue-100">

        <h1 class="text-4xl mb-3">Reading List</h1>

        <p class="pb-2">To reorder your book list, drag a book to the opposing book location.</p>

        <table id="tbl_book_list" class="table-auto w-full">
            <thead class="bg-gray-200 flex w-full">
                <tr class="flex w-full">
                    <th class="p-4 w-2/5 text-left">Title</th>
                    <th class="p-4 w-2/5 text-left">Author</th>
                    <th class="w-1/5">
                        <select id="sortby" class="mt-2 mr-4 float-right border bg-white rounded px-3 py-2 outline-none">
                            <option class="py-1" value="position">Sort By: List Order</option>
                            <option class="py-1" value="title asc">Sort By: Title (Ascending)</option>
                            <option class="py-1" value="title desc">Sort By: Title (Descending)</option>
                            <option class="py-1" value="author asc">Sort By: Author (Ascending)</option>
                            <option class="py-1" value="author desc">Sort By: Author (Descending)</option>
                        </select>
                    </th>
                </tr>
            </thead>
            <tbody id="bl_tbody" class="connectedSortable flex flex-col items-center justify-between overflow-y-scroll w-full">
                @if ($books->count())
                    @foreach ($books as $book)
                        <tr class="flex w-full tbl-border ui-sortable-handle" data-book-id="{{ $book->id }}">
                            <td class="p-4 w-2/5">{{ $book->title }}</td>
                            <td class="p-4 w-2/5">{{ $book->author }}</td>
                            <td class="p-4 w-1/5 bl-td-w">
                                <a href="/books/{{ $book->id }}" class="btn-icon-wrap hover:text-blue-500 cursor-pointer btn-details"><i class="fas fa-book btn-details"></i> Details</a>
                                <form action="{{ route('books.destroy', $book) }}" method="post" class="delete-book-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="focus:border-none border-none btn-icon-wrap hover:text-red-500 cursor-pointer">
                                        <i class="fas fa-trash btn-delete-book"></i> 
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <tr class="p-4 w-1/4 no-books"><td class="p-4 w-1/4">No books ..</td></tr>
                @endif
            </tbody>
        </table>

    </div>
</div>
@endsection

@section('framework-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://kit.fontawesome.com/e9a5865a71.js" crossorigin="anonymous"></script>
@endsection

@section('scripts')
<script>
    $('#sortby').on('click', function(){
        let sortby = $(this).val();
        var host   = $(location).attr('href');  
        let token  = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'post',  
            url: 'books-sorted',
            dataType: 'json',
            data: {
                sortby: sortby,
                _token: token
            },
            success: function(data) {
                let rows = '';

                $.each(data, function(key, value) {
                    rows += '<tr class="flex w-full tbl-border ui-sortable-handle selected" data-book-id="' + value.id + '">' +
                                '<td class="p-4 w-2/5">' + value.title + '</td>' +
                                '<td class="p-4 w-2/5">' + value.author +'</td>' +
                                '<td class="p-4 w-1/5 bl-td-w">' +
                                    '<a href="/books/6" class="btn-icon-wrap hover:text-blue-500 cursor-pointer btn-details"><i class="fas fa-book btn-details" aria-hidden="true"></i> Details</a>' +
                                    '<form action="' + host + '/' + value.id + '" method="post" class="delete-book-form">' +
                                        '<input type="hidden" name="_token" value="' + token +'">' +
                                        '<input type="hidden" name="_method" value="DELETE">' +
                                        '<button type="submit" class="focus:border-none border-none btn-icon-wrap hover:text-red-500 cursor-pointer btn-delete-book">' +
                                        '<i class="fas fa-trash btn-delete-book" aria-hidden="true"></i>Delete</button>' +
                                    '</form>' +
                                '</td>' +
                            '</tr>';
                });
                
                $('#bl_tbody').html(rows);
            }
        });
    });
</script>
<script src="{{ asset('js/main.js') }}"></script>
@endsection