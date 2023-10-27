{{-- 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<style>
    body {
        background-color: #e6e6e6;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-image: url('https://images.unsplash.com/photo-1491981253108-6bfe42f1b979');
        background-size: cover;
        background-position: center;
    }

    .login-box {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        padding: 40px;
        text-align: center;
        animation: slide-up 0.8s ease-in-out;
    }

    h1 {
        color: #333333;
        font-size: 36px;
        margin-bottom: 30px;
    }

    form {
        text-align: left;
    }

    label {
        color: #666666;
        display: block;
        font-size: 18px;
        margin-bottom: 10px;
        text-align: left;
    }

    input[type="text"],
    input[type="password"] {
        background-color: #f2f2f2;
        border: none;
        border-radius: 5px;
        display: block;
        font-size: 18px;
        margin-bottom: 20px;
        padding: 10px;
        width: 100%;
    }

    .remember-me {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    input[type="checkbox"] {
        margin-right: 10px;
    }

    input[type="submit"] {
        background-color: #333333;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        cursor: pointer;
        font-size: 20px;
        margin-top: 30px;
        padding: 15px 30px;
        transition: all 0.3s ease-in-out;
    }

    input[type="submit"]:hover {
        background-color: #4d4d4d;
        transform: scale(1.05);
    }

    @keyframes slide-up {
        0% {
            transform: translateY(100%);
        }

        100% {
            transform: translateY(0%);
        }
    }
</style>

<body>
    <div class="container">
        <div class="login-box">
            <h1>Login</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email">Email:</label>
                <input type="text" id="email" name="email" @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember-me" style="margin-bottom: 0px;">Remember Me</label>
                </div>
                <input type="submit" value="Login">


            </form>
        </div>
    </div>
</body>

</html>
