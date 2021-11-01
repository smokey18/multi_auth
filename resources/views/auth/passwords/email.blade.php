<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/my-login.css') }}">
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="{{ asset('img/logo.jpg') }}" alt="image">
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Forgot Password</h4>
                            <form method="POST" class="my-login-validation" action="{{ route('password.email') }}">
                                @csrf

                                <div class="results">
                                    @if (Session::get('status'))
                                        <div class="alert alert-success">
                                            {{ Session::get('status') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email"
                                        value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
                                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>

                                        <div class="form-text text-muted">
                                            By clicking "Reset Password" we will send a password reset link
                                        </div>
                                    </div>

                                    <div class="form-group m-0">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Send Password Link
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ asset('js/my-login.js') }}"></script>
    </body>

    </html>
