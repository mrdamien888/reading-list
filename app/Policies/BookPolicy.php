<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }
    
}