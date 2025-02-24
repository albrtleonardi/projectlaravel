<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use App\Models\Book;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    //
    public function buy(Request $request, Book $book)
    {
        // Ensure $book->quantity is a valid numeric value.
        $availableQuantity = $book->quantity ?? 0;
    
        $request->validate([
            'buy_quantity' => 'required|integer|min:1|max:' . $availableQuantity,
        ], [
            'buy_quantity.max' => 'Not enough quantity available.'
        ]);
    
        $buyQuantity = $request->buy_quantity;
    
        // Start transaction
        DB::beginTransaction();
    
        try {
            // Create transaction header (for simplicity, total is calculated for this single book)
            $total = $book->price * $buyQuantity;
            $transactionHeader = TransactionHeader::create([
                'user_id' => Auth::id(),
                'total'   => $total,
            ]);
    
            // Create transaction detail
            TransactionDetail::create([
                'transaction_header_id' => $transactionHeader->id,
                'book_id'               => $book->id,
                'quantity'              => $buyQuantity,
                'price'                 => $book->price,
            ]);
    
            // Decrement quantity and check if it should be removed
            $book->quantity -= $buyQuantity;
            if ($book->quantity <= 0) {
                $book->delete();
            } else {
                $book->save();
            }
    
            DB::commit();
            return redirect()->route('user.dashboard')->with('success', 'Book purchased successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaction failed: ' . $e->getMessage());
        }
    }
    
    
    // Show transaction history for the user
    public function history()
    {
        $transactions = TransactionHeader::with('transactionDetails.book')->where('user_id', Auth::id())->get();
        return view('user.history', compact('transactions'));
    }
}
