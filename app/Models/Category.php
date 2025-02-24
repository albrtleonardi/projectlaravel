<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Book;

class Category extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name'];


    public function book(){
        return $this->hasMany(Book::class);
    }
}
