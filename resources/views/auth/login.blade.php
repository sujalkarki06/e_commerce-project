<div class="wrapper">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1>Login</h1>

        <!-- Email Address -->
        <div class="input-box">
            <x-text-input placeholder="Email" id="email" class="input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="error-message" />
        </div>

        <!-- Password -->
        <div class="input-box">
            <x-text-input placeholder="Password" id="password" class="input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="error-message" />
        </div>

        <!-- Remember Me -->
        <div class="input-box">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="forget">
            @if (Route::has('password.request'))
                <a class="forget" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div><br>  

        <button class="btn">Login</button><br><br>

        <div class="link">
            <div class="or-register">
                <span class="line"></span>
                <span>or login with</span>
                <span class="line"></span>
            </div>
            <div class="social-media">
                <a href="https://facebook.com"><img class="icon" src="/images/facebook.png" alt="Facebook"></a>
                <a href="https://instagram.com"><img class="icon" src="/images/instagram.png" alt="Instagram"></a>
                <a href="https://linkedin.com"><img class="icon" src="/images/linkedin.png" alt="LinkedIn"></a>
            </div>
        </div>

        <div class="register-link">
            <p class="forget">Don't have an account? <a href="{{ route('register') }}" class="link">Register</a></p>
        </div>
    </form>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #0A192F; /* Dark Cyan-Blue background */
    }

    .wrapper {
        background-color: #FFFFFF; /* White background */
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }

    h1 {
        margin-bottom: 1rem;
        font-size: 1.5rem;
        color: #64FDDA; /* Teal for heading */
    }

    .input-box {
        margin-bottom: 1rem;
    }

    .input {
        border: 1px solid #64FDDA; /* Teal border */
        border-radius: 4px;
        padding: 0.75rem;
        width: 100%;
        background-color: #CBD5F5; /* Light Blue background */
        color: #0A192F; /* Dark Cyan-Blue text color */
    }

    .error-message {
        color: #e74c3c; /* Red for error messages */
        font-size: 0.875rem;
    }

    .btn {
        background-color: #64FDDA; /* Teal for button */
        color: #0A192F; /* Dark Cyan-Blue text color */
        border: none;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #52D4BA; /* Slightly darker teal for hover effect */
    }

    .link {
        margin-top: 1.5rem;
    }

    .or-register {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .or-register .line {
        flex: 1;
        height: 1px;
        background: #64FDDA; /* Teal line */
    }

    .or-register span {
        margin: 0 1rem;
        color: #0A192F; /* Dark Cyan-Blue text color */
    }

    .social-media {
        margin-bottom: 1rem;
    }

    .social-media .icon {
        width: 24px;
        height: 24px;
        margin: 0 0.5rem;
    }

    .register-link {
        margin-top: 1rem;
    }

    .link, .forget {
        color: #64FDDA; /* Teal for links */
        text-decoration: underline;
        font-size: 0.875rem;
    }

    .link:hover, .forget:hover {
        color: #52D4BA; /* Slightly darker teal on hover */
    }
</style>
