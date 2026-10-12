
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Hade</title>
    @vite(['resources/css/login.css', 'resources/js/app.js'])
</head>
<body class="login-page">
    <main class="login-container">
        <section class="login-card">
            <header class="login-header">
                <h1>Create Account</h1>
                <p>Create your Hade account to start shopping.</p>
            </header>

            @if ($errors->any())
                <div class="login-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        placeholder="Enter your username"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="At least 8 characters"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Re-enter your password"
                        autocomplete="new-password"
                        minlength="8"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    Create Account
                </button>
            </form>

            <p class="register-link">
                Already have an account?
                <a href="{{ route('login') }}">Sign In</a>
            </p>

            <p class="login-footer">
                Create your account to continue shopping.
            </p>

            <p class="login-copyright">
                &copy; {{ date('Y') }} Hade. All rights reserved.
            </p>
        </section>
    </main>
</body>
</html>