@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Dashboard - Available Books</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Buy</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category->name }}</td>
                <td>{{ $book->quantity }}</td>
                <td>${{ $book->price }}</td>
                <td>
                    <form action="{{ route('user.buy', $book) }}" method="POST">
                        @csrf
                        <input type="number" name="buy_quantity" min="1" max="{{ $book->quantity }}" value="1" style="width:70px;" required>
                        <button type="submit" class="btn btn-success btn-sm">Buy</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection