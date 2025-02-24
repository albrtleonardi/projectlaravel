<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;

class UserBookController extends Controller
{
    //
    public function dashboard(){
        $books = Book::where('quantity', '>', 0)->with('category')->get();
        return view('user.dashboard', compact('books'));
    }
}
