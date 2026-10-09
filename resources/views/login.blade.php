<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="card">
        <header>
            <h1>Login</h1>
        </header>

    <div class="card">
    <p>Sign in to access your dashboard.</p>

    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf

        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            value="{{ old('username') }}"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            required
        >

        <button type="submit">Login</button>
    </form>

        <p>Sign in to access your dashboard.</p>

    </div>
</body>
<footer>
    <p>This page can only be accessed after logging in.</p>
    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
</footer>
</html>