<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel App') }}</title>
    <!-- Link to your CSS file if needed -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Simple inline styles for demonstration */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header { background-color: #3490dc; padding: 1rem; }
        header nav a { color: #fff; margin-right: 1rem; text-decoration: none; }
        main { padding: 2rem; }
        footer { background-color: #f5f5f5; text-align: center; padding: 1rem; margin-top: 2rem; }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">Home</a>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('profile.edit') }}">Profile</a>
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                @elseif(auth()->user()->role === 'user')
                    <a href="{{ route('user.dashboard') }}">User Dashboard</a>
                    <a href="{{ route('user.history' }}">History</a>
                @endif

                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:#fff; cursor:pointer;">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Laravel App</p>
    </footer>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>