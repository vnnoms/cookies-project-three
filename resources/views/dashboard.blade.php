<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
<div class="card">
    <header>
        <h1>Dashboard</h1>

        <form action="{{ url('/logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </header>

    <h2>
        Welcome to {{ config('app.name', 'Laravel') }}
        {{ Auth::user()->full_name }}!
    </h2>

    <p>This page can only be accessed after logging in.</p>

    <p>
        Username: {{ Auth::user()->username }}
    </p>
</div>
</body>