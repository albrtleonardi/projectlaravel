<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Book;
use App\Models\TransactionHeader;

class TransactionDetail extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'transaction_header_id',
        'book_id',
        'quantity',
        'price',
    ];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function transactionHeader(){
        return $this->belongsTo(TransactionHeader::class);
    }

}
