<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Category;

class Book extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'quantity',
        'price',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
