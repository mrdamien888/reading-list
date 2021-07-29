@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-3/6 rounded-lg p-10">
        <div class="bg-white rounded-lg overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $book->title }}</div>
                <p class="text-gray-700 text-base"><label class="text-gray-700 font-bold">Author:</label> {{ $book->author }}</p>
                <p class="text-gray-700 text-base"><label class="text-gray-700 font-bold">Publication Date:</label> {{ date("m-d-Y", strtotime($book->pub_date)) }}</p>
                <p class="text-gray-700 text-base"><label class="text-gray-700 font-bold">Pages:</label> {{ $book->pages }}</p>
                <label class="mt-8 text-gray-700 font-bold block">Overview</label>
                <p class="text-gray-700 text-base">{{ $book->overview }}</p>
            </div>
        </div>
    </div>
</div>
@endsection