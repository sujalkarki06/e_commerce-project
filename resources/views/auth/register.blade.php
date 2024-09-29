<div class="wrapper">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h1>Register</h1>

        <!-- Name -->
        <div class="input-box">
            <x-text-input placeholder="Name" id="name" class="input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="error-message" />
        </div>

        <!-- Email Address -->
        <div class="input-box">
            <x-text-input placeholder="Email" id="email" class="input" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="error-message" />
        </div>

        <!-- Password -->
        <div class="input-box">
            <x-text-input placeholder="Password" id="password" class="input" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="error-message" />
        </div>

        <!-- Confirm Password -->
        <div class="input-box">
            <x-text-input placeholder="Confirm Password" id="password_confirmation" class="input" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />
        </div>

        <input type="hidden" id="role" name="role" value="2"> <!-- Default role for regular users -->

        <button class="btn">Register</button><br><br>

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
            <a href="{{ route('login') }}" class="login-link">
                Already registered?
            </a>
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
        background-color: #0A0A3F; /* Dark blue background */
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
        color: #1E90FF; /* Neon blue for heading */
    }

    .input-box {
        margin-bottom: 1rem;
    }

    .input {
        border: 1px solid #00FFFF; /* Teal border */
        border-radius: 4px;
        padding: 0.75rem;
        width: 100%;
        background-color: #F0F8FF; /* Very light blue background */
        color: #0A0A3F; /* Dark text color */
    }

    .error-message {
        color: #FF4500; /* Red for error messages */
        font-size: 0.875rem;
    }

    .btn {
        background-color: #1E90FF; /* Neon blue for button */
        color: #FFFFFF; /* White text color */
        border: none;
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #007ACC; /* Darker blue for hover effect */
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
        background: #00FFFF; /* Teal line */
    }

    .or-register span {
        margin: 0 1rem;
        color: #666;
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

    .login-link {
        color: #1E90FF; /* Neon blue for login link */
        text-decoration: underline;
        font-size: 0.875rem;
    }

    .login-link:hover {
        color: #007ACC; /* Darker blue on hover */
    }
</style>