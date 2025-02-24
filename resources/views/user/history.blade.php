@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Purchase History</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Total</th>
                <th>Date</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>${{ $transaction->total }}</td>
                <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <ul>
                        @foreach($transaction->transactionDetails as $detail)
                            <li>{{ $detail->book->title }} ({{ $detail->quantity }}) - ${{ $detail->price }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection