<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function dashboard(){
        $books = Book::all();
        return view('admin.dashboard', compact('books'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function edit(Book $book){
        $categories = Category::all();
        return view('admin.update', compact('book', 'categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        Book::create($request->all());
        return redirect()->route('admin.dashboard');
    }

    public function update(Request $request, Book $book){
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        $book->update($request->all());
        return redirect()->route('admin.dashboard');
    }

    public function delete(Book $book){
        $book->delete();
        return redirect()->route('admin.dashboard');
    }
}
