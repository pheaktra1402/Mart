<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create account</title>
    <style>
        :root {
            --bg: #eef2f5;
            --surface: #ffffff;
            --text: #1b2a33;
            --muted: #5d6f7a;
            --border: #c9d4db;
            --accent: #0b6e74;
            --accent-hover: #095a5f;
            --error: #b42318;
            --error-bg: #fef3f2;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            background: var(--bg);
            color: var(--text);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
            line-height: 1.5;
        }

        .register {
            width: 100%;
            max-width: 400px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 36px 32px 32px;
        }

        .register h1 {
            margin: 0 0 4px;
            font-size: 1.5rem;
            font-weight: 650;
            letter-spacing: -0.01em;
        }

        .register .intro {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .field input {
            width: 100%;
            padding: 11px 12px;
            font: inherit;
            color: var(--text);
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 6px;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .field input::placeholder { color: #8b9aa4; }

        .field input:focus-visible {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(11, 110, 116, 0.22);
        }

        .field.has-error input {
            border-color: var(--error);
            background: var(--error-bg);
        }

        .field-error {
            margin-top: 6px;
            color: var(--error);
            font-size: 0.85rem;
        }

        .btn {
            width: 100%;
            margin-top: 6px;
            padding: 12px 16px;
            font: inherit;
            font-weight: 600;
            color: #fff;
            background: var(--accent);
            border: 0;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn:hover { background: var(--accent-hover); }

        .btn:focus-visible {
            outline: 3px solid rgba(11, 110, 116, 0.4);
            outline-offset: 2px;
        }

        .switch {
            margin: 20px 0 0;
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .switch a {
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
        }

        .switch a:hover { text-decoration: underline; }

        @media (max-width: 440px) {
            body { padding: 12px; align-items: start; }
            .register { padding: 28px 20px 24px; }
        }
    </style>
</head>
<body>
    <main class="register">
        <h1>Create account</h1>
        <p class="intro">Fill in your details to get started.</p>

        <form method="POST" action="/register" novalidate>
            @csrf

            <div class="field @error('name') has-error @enderror">
                <label for="name">Full name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Your full name"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                    @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                >
                @error('name')
                    <div class="field-error" id="name-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field @error('email') has-error @enderror">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="you@example.com"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                    @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                >
                @error('email')
                    <div class="field-error" id="email-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field @error('password') has-error @enderror">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Choose a password"
                    autocomplete="new-password"
                    required
                    @error('password') aria-invalid="true" aria-describedby="password-error" @enderror
                >
                @error('password')
                    <div class="field-error" id="password-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="field @error('password_confirmation') has-error @enderror">
                <label for="password_confirmation">Confirm password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Re-enter your password"
                    autocomplete="new-password"
                    required
                    @error('password_confirmation') aria-invalid="true" aria-describedby="password-confirmation-error" @enderror
                >
                @error('password_confirmation')
                    <div class="field-error" id="password-confirmation-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Create account</button>
        </form>

        <p class="switch">Already have an account? <a href="/login">Log in</a></p>
    </main>
</body>
</html>